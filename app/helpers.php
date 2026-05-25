<?php

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    return $pdo;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string
{
    return BASE_URL . ($path ? '/index.php?route=' . $path : '/index.php');
}

function asset(string $path): string
{
    return BASE_URL . '/assets/' . ltrim($path, '/');
}

function redirect(string $route = ''): void
{
    header('Location: ' . url($route));
    exit;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function current_user(): ?array
{
    if (empty($_SESSION['user_id'])) {
        return null;
    }

    $stmt = db()->prepare('SELECT * FROM users WHERE id = ? AND status = "active"');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}

function require_login(): array
{
    $user = current_user();
    if (!$user) {
        flash('warning', 'Devam etmek icin oturum acmalisiniz.');
        redirect('login');
    }

    return $user;
}

function require_admin(): array
{
    $user = require_login();
    if ($user['role'] !== 'admin') {
        flash('danger', 'Bu sayfa icin admin yetkisi gerekir.');
        redirect('');
    }

    return $user;
}

function view(string $template, array $data = []): void
{
    extract($data);
    $currentUser = current_user();
    require __DIR__ . '/views/layouts/header.php';
    require __DIR__ . '/views/' . $template . '.php';
    require __DIR__ . '/views/layouts/footer.php';
}

function money(float $amount): string
{
    return number_format($amount, 2, ',', '.') . ' TL';
}

