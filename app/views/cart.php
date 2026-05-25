<h1 class="h3 mb-4">Sepetim</h1>
<?php $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)); ?>
<?php if ($cart): ?>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Urun</th><th>Adet</th><th>Birim Fiyat</th><th>Toplam</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($cart as $item): ?>
                <tr>
                    <td><?= e($item['title']) ?></td>
                    <td><?= (int) $item['quantity'] ?></td>
                    <td><?= money((float) $item['price']) ?></td>
                    <td><?= money((float) $item['price'] * (int) $item['quantity']) ?></td>
                    <td><a class="btn btn-sm btn-outline-danger" href="<?= url('cart_remove&id=' . $item['id']) ?>">Cikar</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <strong>Genel Toplam: <?= money((float) $total) ?></strong>
        <a class="btn btn-primary" href="<?= url('checkout') ?>">Odeme Ekrani</a>
    </div>
<?php else: ?>
    <div class="alert alert-info">Sepetiniz bos.</div>
<?php endif; ?>

