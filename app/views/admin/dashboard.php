<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Admin Paneli</h1>
    <a class="btn btn-primary" href="<?= url('admin_product') ?>">Urun Ekle</a>
</div>

<ul class="nav nav-tabs mb-3" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#products">Urunler</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders">Siparisler</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#users">Kullanicilar</button></li>
</ul>

<div class="tab-content">
    <section class="tab-pane fade show active" id="products">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Kitap</th><th>Fiyat</th><th>Stok</th><th>Durum</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= e($product['title']) ?></td>
                        <td><?= money((float) $product['price']) ?></td>
                        <td><?= (int) $product['stock'] ?></td>
                        <td><?= $product['is_active'] ? 'Satista' : 'Kapali' ?></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="<?= url('admin_product&id=' . $product['id']) ?>">Duzenle</a>
                            <a class="btn btn-sm btn-outline-danger" href="<?= url('admin_product_delete&id=' . $product['id']) ?>" onclick="return confirm('Silinsin mi?')">Sil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="tab-pane fade" id="orders">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>No</th><th>Kullanici</th><th>Tutar</th><th>Durum</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= (int) $order['id'] ?></td>
                        <td><?= e($order['user_name']) ?></td>
                        <td><?= money((float) $order['total_amount']) ?></td>
                        <td><?= e(ORDER_STEPS[$order['status']] ?? $order['status']) ?></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="<?= url('order_detail&id=' . $order['id']) ?>">Detay</a>
                            <?php if (!in_array($order['status'], ['delivered', 'completed', 'cancelled'], true)): ?>
                                <a class="btn btn-sm btn-success" href="<?= url('admin_order_next&id=' . $order['id']) ?>">Ileri</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="tab-pane fade" id="users">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Ad Soyad</th><th>E-posta</th><th>Rol</th><th>Bakiye</th><th>Durum</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= e($user['name']) ?></td>
                        <td><?= e($user['email']) ?></td>
                        <td><?= e($user['role']) ?></td>
                        <td><?= money((float) $user['wallet_balance']) ?></td>
                        <td><?= e($user['status']) ?></td>
                        <td class="text-end">
                            <?php if ($user['role'] !== 'admin'): ?>
                                <a class="btn btn-sm btn-outline-primary" href="<?= url('admin_user&id=' . $user['id']) ?>">Duzenle</a>
                                <?php if ($user['status'] === 'active'): ?>
                                    <a class="btn btn-sm btn-outline-warning" href="<?= url('admin_user_status&id=' . $user['id'] . '&status=passive') ?>">Dondur</a>
                                <?php else: ?>
                                    <a class="btn btn-sm btn-outline-success" href="<?= url('admin_user_status&id=' . $user['id'] . '&status=active') ?>">Aktif Et</a>
                                <?php endif; ?>
                                <a class="btn btn-sm btn-outline-danger" href="<?= url('admin_user_delete&id=' . $user['id']) ?>" onclick="return confirm('Kullanici silinsin mi?')">Sil</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
