<h1 class="h3 mb-4">Siparislerim</h1>
<?php foreach ($orders as $order): ?>
    <div class="order-row">
        <div>
            <strong>#<?= (int) $order['id'] ?> - <?= money((float) $order['total_amount']) ?></strong>
            <div class="small text-muted"><?= e($order['created_at']) ?> / <?= e(ORDER_STEPS[$order['status']] ?? $order['status']) ?></div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-sm btn-outline-primary" href="<?= url('order_detail&id=' . $order['id']) ?>">Detay</a>
            <?php if ($order['status'] === 'pending'): ?>
                <a class="btn btn-sm btn-outline-danger" href="<?= url('cancel_order&id=' . $order['id']) ?>">Iptal Et</a>
            <?php endif; ?>
            <?php if ($order['status'] === 'delivered'): ?>
                <a class="btn btn-sm btn-success" href="<?= url('confirm_delivery&id=' . $order['id']) ?>">Urunleri Teslim Aldim</a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<?php if (!$orders): ?>
    <div class="alert alert-info">Henuz siparisiniz yok.</div>
<?php endif; ?>

