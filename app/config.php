<?php

define('APP_NAME', 'Metin Kitap');
define('BASE_URL', '/book_sales/public');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'book_sales');
define('DB_USER', 'root');
define('DB_PASS', '');

define('ORDER_STEPS', [
    'pending' => 'Onay bekliyor',
    'approved' => 'Urunleriniz tedarik ediliyor',
    'packing' => 'Urunleriniz kutulaniyor',
    'cargo' => 'Urunleriniz kargoya veriliyor',
    'on_way' => 'Urunleriniz size dogru yola cikti',
    'delivered' => 'Urunleriniz size teslim edilmistir',
    'completed' => 'Teslim alindi',
    'cancelled' => 'Iptal edildi',
]);

