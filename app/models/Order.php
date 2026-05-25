<?php

class Order
{
    public static function create(int $userId, array $cart, string $address, float $walletUsed, float $cardPaid): int
    {
        db()->beginTransaction();
        try {
            $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
            $stmt = db()->prepare('INSERT INTO orders (user_id, total_amount, wallet_used, card_paid, shipping_address, status) VALUES (?, ?, ?, ?, ?, "pending")');
            $stmt->execute([$userId, $total, $walletUsed, $cardPaid, $address]);
            $orderId = (int) db()->lastInsertId();

            $itemStmt = db()->prepare('INSERT INTO order_items (order_id, product_id, product_title, quantity, unit_price) VALUES (?, ?, ?, ?, ?)');
            foreach ($cart as $item) {
                $itemStmt->execute([$orderId, $item['id'], $item['title'], $item['quantity'], $item['price']]);
                Product::decreaseStock((int) $item['id'], (int) $item['quantity']);
            }

            if ($walletUsed > 0) {
                $walletStmt = db()->prepare('UPDATE users SET wallet_balance = wallet_balance - ? WHERE id = ?');
                $walletStmt->execute([$walletUsed, $userId]);
            }

            db()->commit();
            return $orderId;
        } catch (Throwable $e) {
            db()->rollBack();
            throw $e;
        }
    }

    public static function forUser(int $userId): array
    {
        $stmt = db()->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public static function all(): array
    {
        return db()->query('SELECT o.*, u.name AS user_name FROM orders o JOIN users u ON u.id = o.user_id ORDER BY o.created_at DESC')->fetchAll();
    }

    public static function items(int $orderId): array
    {
        $stmt = db()->prepare('SELECT * FROM order_items WHERE order_id = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM orders WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function updateStatus(int $id, string $status): void
    {
        $stmt = db()->prepare('UPDATE orders SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }

    public static function cancelByUser(int $id, int $userId): bool
    {
        $order = self::find($id);
        if (!$order || (int) $order['user_id'] !== $userId || $order['status'] !== 'pending') {
            return false;
        }

        db()->beginTransaction();
        try {
            self::updateStatus($id, 'cancelled');
            User::addWallet($userId, (float) $order['total_amount']);

            foreach (self::items($id) as $item) {
                $stmt = db()->prepare('UPDATE products SET stock = stock + ? WHERE id = ?');
                $stmt->execute([$item['quantity'], $item['product_id']]);
            }

            db()->commit();
            return true;
        } catch (Throwable $e) {
            db()->rollBack();
            throw $e;
        }
    }
}

