<?php

class User
{
    public static function find(int $id): ?array
    {
        $stmt = db()->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function byEmail(string $email): ?array
    {
        $stmt = db()->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public static function allUsers(): array
    {
        return db()->query('SELECT * FROM users ORDER BY role, name')->fetchAll();
    }

    public static function create(array $data, string $role = 'user'): void
    {
        $stmt = db()->prepare('INSERT INTO users (name, email, password, address, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['address'] ?? '',
            $role,
        ]);
    }

    public static function updateProfile(int $id, array $data): void
    {
        if (!empty($data['password'])) {
            $stmt = db()->prepare('UPDATE users SET name=?, email=?, address=?, password=? WHERE id=?');
            $stmt->execute([$data['name'], $data['email'], $data['address'], password_hash($data['password'], PASSWORD_DEFAULT), $id]);
            return;
        }

        $stmt = db()->prepare('UPDATE users SET name=?, email=?, address=? WHERE id=?');
        $stmt->execute([$data['name'], $data['email'], $data['address'], $id]);
    }

    public static function updateStatus(int $id, string $status): void
    {
        $stmt = db()->prepare('UPDATE users SET status = ? WHERE id = ? AND role <> "admin"');
        $stmt->execute([$status, $id]);
    }

    public static function adminUpdate(int $id, array $data): void
    {
        $stmt = db()->prepare('UPDATE users SET name=?, email=?, address=?, wallet_balance=?, status=? WHERE id=? AND role <> "admin"');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['address'],
            (float) $data['wallet_balance'],
            $data['status'] === 'active' ? 'active' : 'passive',
            $id,
        ]);
    }

    public static function delete(int $id): void
    {
        $stmt = db()->prepare('DELETE FROM users WHERE id = ? AND role <> "admin"');
        $stmt->execute([$id]);
    }

    public static function addWallet(int $id, float $amount): void
    {
        $stmt = db()->prepare('UPDATE users SET wallet_balance = wallet_balance + ? WHERE id = ?');
        $stmt->execute([$amount, $id]);
    }
}
