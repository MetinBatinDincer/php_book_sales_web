<div class="row g-4 align-items-start">
    <div class="col-md-5">
        <img src="<?= e($product['image_url']) ?>" class="img-fluid rounded product-detail-img" alt="<?= e($product['title']) ?>">
    </div>
    <div class="col-md-7">
        <h1><?= e($product['title']) ?></h1>
        <p class="text-muted"><?= e($product['author']) ?></p>
        <p><?= nl2br(e($product['description'])) ?></p>
        <div class="d-flex gap-3 align-items-center mb-3">
            <span class="h4 mb-0"><?= money((float) $product['price']) ?></span>
            <span class="badge text-bg-secondary">Stok: <?= (int) $product['stock'] ?></span>
        </div>
        <form method="post" action="<?= url('cart_add') ?>" class="d-flex gap-2">
            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
            <input class="form-control quantity-input" type="number" name="quantity" value="1" min="1" max="<?= (int) $product['stock'] ?>">
            <button class="btn btn-primary">Sepete Ekle</button>
        </form>
    </div>
</div>

