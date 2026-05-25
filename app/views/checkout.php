<?php $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)); ?>
<?php $walletUsed = min((float) $user['wallet_balance'], (float) $total); ?>
<h1 class="h3 mb-4">Odeme ve Siparis</h1>
<div class="row g-4">
    <div class="col-lg-7">
        <form method="post">
            <label class="form-label">Teslimat Adresi</label>
            <textarea class="form-control mb-3" name="shipping_address" rows="4" required><?= e($user['address']) ?></textarea>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Kart Numarasi</label>
                    <input class="form-control" value="4111 1111 1111 1111" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">CVV</label>
                    <input class="form-control" value="123" required>
                </div>
            </div>
            <button class="btn btn-primary mt-3">Siparisi Tamamla</button>
        </form>
    </div>
    <div class="col-lg-5">
        <div class="summary-box">
            <div class="d-flex justify-content-between"><span>Sepet Toplami</span><strong><?= money((float) $total) ?></strong></div>
            <div class="d-flex justify-content-between"><span>Kullanilan Bakiye</span><strong><?= money($walletUsed) ?></strong></div>
            <hr>
            <div class="d-flex justify-content-between h5"><span>Karttan Cekilecek</span><strong><?= money((float) $total - $walletUsed) ?></strong></div>
        </div>
    </div>
</div>

