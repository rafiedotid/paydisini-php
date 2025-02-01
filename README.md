<h1 align="center">Paydisini PHP Library</h1>

<p align="center">
  <img src="https://img.shields.io/packagist/v/username/paydisini-php?style=flat-square" alt="Latest Version">
  <img src="https://img.shields.io/packagist/l/username/paydisini-php?style=flat-square" alt="License">
  <img src="https://img.shields.io/packagist/php-v/username/paydisini-php?style=flat-square" alt="PHP Version">
</p>

<p align="center">
  Library PHP untuk integrasi Paydisini Payment Gateway.
</p>

---

<h2>📦 Instalasi</h2>

<p>Install library menggunakan Composer:</p>

```bash
composer require rafiedotid/paydisini-php
```
<h2>🚀 Penggunaan</h2><h3>Inisialisasi</h3>

```php
require 'vendor/autoload.php';
use Paydisini\Paydisini;

$apiKey = 'API_KEY_ANDA';
$paydisini = new Paydisini($apiKey);
```
<h3>Mendapatkan Channel Pembayaran</h3>

```php
$channels = $paydisini->getPaymentChannels();
if($channels['success']) {
    foreach($channels['data'] as $channel) {
        echo "{$channel['name']} - Fee: {$channel['fee']}\n";
    }
}
```
<h3>Membuat Transaksi</h3>

```php
$transaction = $paydisini->createTransaction([
    'unique_code' => 'INV123',
    'service' => 2, // ID channel pembayaran
    'amount' => 100000,
    'note' => 'Pembelian Produk A',
    'valid_time' => 3600, // 1 jam
    'type_fee' => 1 // Fee ditanggung customer
]);

if($transaction['success']) {
    echo "Payment URL: {$transaction['data']['checkout_url']}";
}
```
<h3>Cek Status Transaksi</h3>

```php
$status = $paydisini->getTransactionStatus('INV123');
if($status['success']) {
    echo "Status: {$status['data']['status']}";
}
```
<h3>Handle Callback</h3>

```php
$callback = Paydisini::handleCallback($apiKey, $_POST);
if($callback['success']) {
    // Update status transaksi di database
    $status = $callback['data']['status'];
    $amount = $callback['data']['amount'];
    // ... proses update
}
header('Content-Type: application/json');
echo json_encode(['success' => true]);
```

<h2>📚 Dokumentasi Lengkap</h2><p>Untuk dokumentasi lengkap, lihat <a href="https://paydisini.co.id">dokumentasi resmi Paydisini</a>.</p>
<h2>📝 Catatan Penting</h2><ul> <li>Pastikan meng-whitelist IP Paydisini: <code>45.87.242.188</code></li> <li>Simpan API Key dengan aman</li> <li>Handle callback dengan benar untuk update status transaksi</li> <li>Cek selalu minimum dan maksimum transaksi untuk setiap channel</li> </ul>
<h2>📜 License</h2><p>This project is licensed under the MIT License. See the <a href="LICENSE">LICENSE</a> file for details.</p><p align="center"> Made with ❤️ by <a href="https://github.com/rafiedotid">rafiedotid</a> </p>
