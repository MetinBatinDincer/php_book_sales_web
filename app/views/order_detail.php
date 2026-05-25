<h1 class="h3">Siparis #<?= (int) $order['id'] ?></h1>
<p class="text-muted">Durum: <?= e(ORDER_STEPS[$order['status']] ?? $order['status']) ?></p>
<div class="table-responsive">
    <table class="table">
        <thead><tr><th>Urun</th><th>Adet</th><th>Birim Fiyat</th><th>Toplam</th></tr></thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= e($item['product_title']) ?></td>
                <td><?= (int) $item['quantity'] ?></td>
                <td><?= money((float) $item['unit_price']) ?></td>
                <td><?= money((float) $item['unit_price'] * (int) $item['quantity']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="summary-box">
    <p><strong>Teslimat Adresi:</strong> <?= nl2br(e($order['shipping_address'])) ?></p>
    <p class="mb-0"><strong>Toplam:</strong> <?= money((float) $order['total_amount']) ?> / <strong>Bakiye:</strong> <?= money((float) $order['wallet_used']) ?> / <strong>Kart:</strong> <?= money((float) $order['card_paid']) ?></p>
</div>

