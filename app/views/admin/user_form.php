<h1 class="h3 mb-4">Kullanici Duzenle</h1>
<form method="post" action="<?= url('admin_user_save') ?>" class="row g-3">
    <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">
    <div class="col-md-6">
        <label class="form-label">Ad Soyad</label>
        <input class="form-control" name="name" value="<?= e($user['name']) ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">E-posta</label>
        <input class="form-control" type="email" name="email" value="<?= e($user['email']) ?>" required>
    </div>
    <div class="col-12">
        <label class="form-label">Adres</label>
        <textarea class="form-control" name="address" rows="4"><?= e($user['address']) ?></textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Site Bakiyesi</label>
        <input class="form-control" type="number" step="0.01" name="wallet_balance" value="<?= e($user['wallet_balance']) ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Hesap Durumu</label>
        <select class="form-select" name="status">
            <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Aktif</option>
            <option value="passive" <?= $user['status'] === 'passive' ? 'selected' : '' ?>>Pasif</option>
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Kaydet</button>
        <a class="btn btn-outline-secondary" href="<?= url('admin') ?>">Vazgec</a>
    </div>
</form>

