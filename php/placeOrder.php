<?php
require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'SB-Mid-server-6hH7rXKhLTx98p1LJWNMiJPh';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Validasi input dari POST
if (!isset($_POST['total']) || !isset($_POST['items']) || !isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['phone'])) {
    echo "Invalid request. Missing required parameters.";
    exit;
}

// Parameter transaksi
$params = array(
    'transaction_details' => array(
        'order_id' => rand(), // Gunakan uniqid() untuk ID yang unik
        'gross_amount' => (float)$_POST['total'], // Validasi tipe data float untuk total
    ),
    'item_details' => json_decode($_POST['items'], true), // Decode JSON dari items
    'customer_details' => array(
        'first_name' => $_POST['name'], // Nama pelanggan
        'email' => $_POST['email'], // Email pelanggan
        'phone' => $_POST['phone'], // Nomor telepon pelanggan
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
echo $snapToken;
?>
