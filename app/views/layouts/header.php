<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= asset('style.css') ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= url('') ?>">Metin Kitap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <form class="d-flex ms-lg-4 my-2 my-lg-0" method="get" action="<?= url('') ?>">
                <input type="hidden" name="route" value="">
                <input class="form-control me-2" name="q" placeholder="Kitap veya yazar ara">
                <button class="btn btn-outline-light">Ara</button>
            </form>
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="<?= url('cart') ?>">Sepet</a></li>
                <?php if ($currentUser): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= url('orders') ?>">Siparislerim</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('profile') ?>">Profil</a></li>
                    <?php if ($currentUser['role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= url('admin') ?>">Admin</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="btn btn-sm btn-outline-light ms-lg-2" href="<?= url('logout') ?>">Cikis</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= url('login') ?>">Giris</a></li>
                    <li class="nav-item"><a class="btn btn-sm btn-primary ms-lg-2" href="<?= url('register') ?>">Kayit Ol</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<main class="container py-4">
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-<?= e($_SESSION['flash']['type']) ?>"><?= e($_SESSION['flash']['message']) ?></div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

