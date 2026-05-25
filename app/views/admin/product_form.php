<h1 class="h3 mb-4"><?= $product ? 'Urun Duzenle' : 'Urun Ekle' ?></h1>
<form method="post" action="<?= url('admin_product_save') ?>" enctype="multipart/form-data" class="row g-3">
    <input type="hidden" name="id" value="<?= e($product['id'] ?? '') ?>">
    <div class="col-md-6">
        <label class="form-label">Kitap Adi</label>
        <input class="form-control" name="title" value="<?= e($product['title'] ?? '') ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Yazar</label>
        <input class="form-control" name="author" value="<?= e($product['author'] ?? '') ?>" required>
    </div>
    <div class="col-12">
        <label class="form-label">Aciklama</label>
        <textarea class="form-control" name="description" rows="4" required><?= e($product['description'] ?? '') ?></textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Fiyat</label>
        <input class="form-control" type="number" step="0.01" name="price" value="<?= e($product['price'] ?? '') ?>" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Stok</label>
        <input class="form-control" type="number" name="stock" value="<?= e($product['stock'] ?? '') ?>" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Fotograf URL</label>
        <input class="form-control" name="image_url" value="<?= e($product['image_url'] ?? 'https://picsum.photos/seed/book/600/800') ?>" required>
    </div>
    <div class="col-md-8">
        <label class="form-label">Fotograf Yukle</label>
        <input class="form-control" type="file" name="image_file" accept="image/*">
    </div>
    <div class="col-12">
        <label class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" <?= ($product['is_active'] ?? 1) ? 'checked' : '' ?>>
            <span class="form-check-label">Satista</span>
        </label>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Kaydet</button>
        <a class="btn btn-outline-secondary" href="<?= url('admin') ?>">Vazgec</a>
    </div>
</form>
