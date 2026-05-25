<?php

class Product
{
    public static function all(?string $keyword = null): array
    {
        if ($keyword) {
            $stmt = db()->prepare('SELECT * FROM products WHERE title LIKE ? OR author LIKE ? ORDER BY created_at DESC');
            $like = '%' . $keyword . '%';
            $stmt->execute([$like, $like]);
            return $stmt->fetchAll();
        }

        return db()->query('SELECT * FROM products ORDER BY created_at DESC')->fetchAll();
    }

    public static function active(?string $keyword = null): array
    {
        if ($keyword) {
            $stmt = db()->prepare('SELECT * FROM products WHERE is_active = 1 AND stock > 0 AND (title LIKE ? OR author LIKE ?) ORDER BY created_at DESC');
            $like = '%' . $keyword . '%';
            $stmt->execute([$like, $like]);
            return $stmt->fetchAll();
        }

        return db()->query('SELECT * FROM products WHERE is_active = 1 AND stock > 0 ORDER BY created_at DESC')->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function save(array $data, ?int $id = null): void
    {
        if ($id) {
            $stmt = db()->prepare('UPDATE products SET title=?, author=?, description=?, price=?, stock=?, image_url=?, is_active=? WHERE id=?');
            $stmt->execute([$data['title'], $data['author'], $data['description'], $data['price'], $data['stock'], $data['image_url'], $data['is_active'], $id]);
            return;
        }

        $stmt = db()->prepare('INSERT INTO products (title, author, description, price, stock, image_url, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$data['title'], $data['author'], $data['description'], $data['price'], $data['stock'], $data['image_url'], $data['is_active']]);
    }

    public static function delete(int $id): void
    {
        $stmt = db()->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
    }

    public static function decreaseStock(int $id, int $quantity): void
    {
        $stmt = db()->prepare('UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?');
        $stmt->execute([$quantity, $id, $quantity]);
    }
}

