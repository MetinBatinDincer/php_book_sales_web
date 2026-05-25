<div class="row g-4">
    <div class="col-lg-7">
        <h1 class="h3">Profil Bilgileri</h1>
        <form method="post" class="mt-3">
            <label class="form-label">Ad Soyad</label>
            <input class="form-control mb-3" name="name" value="<?= e($user['name']) ?>" required>
            <label class="form-label">E-posta</label>
            <input class="form-control mb-3" type="email" name="email" value="<?= e($user['email']) ?>" required>
            <label class="form-label">Adres</label>
            <textarea class="form-control mb-3" name="address" rows="4"><?= e($user['address']) ?></textarea>
            <label class="form-label">Yeni Sifre</label>
            <input class="form-control mb-3" type="password" name="password" placeholder="Degistirmeyecekseniz bos birakin">
            <button class="btn btn-primary">Guncelle</button>
        </form>
    </div>
    <div class="col-lg-5">
        <div class="balance-box">
            <span class="text-muted">Site Bakiyesi</span>
            <strong><?= money((float) $user['wallet_balance']) ?></strong>
            <p class="small mb-0">Iptal edilen onay bekleyen siparislerin tutari burada gorunur ve sonraki alisveriste once bu bakiyeden dusulur.</p>
        </div>
        <?php if ($user['role'] !== 'admin'): ?>
            <a class="btn btn-outline-danger mt-3" href="<?= url('deactivate') ?>" onclick="return confirm('Uyelik pasif yapilsin mi?')">Uyeligimi Pasif Et</a>
        <?php endif; ?>
    </div>
</div>

