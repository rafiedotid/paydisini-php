# Paydisini PHP Library

Library PHP untuk integrasi Paydisini Payment Gateway

## Instalasi

```bash
composer require yourname/paydisini-php
Inisialisasi
php
Copy
require 'vendor/autoload.php';
use Paydisini\Paydisini;

$apiKey = 'API_KEY_ANDA';
$paydisini = new Paydisini($apiKey);
Contoh Penggunaan
Mendapatkan Channel Pembayaran
php
Copy
$channels = $paydisini->getPaymentChannels();
if($channels['success']) {
    foreach($channels['data'] as $channel) {
        echo "{$channel['name']} - Fee: {$channel['fee']}\n";
    }
}
Membuat Transaksi
php
Copy
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
Cek Status Transaksi
php
Copy
$status = $paydisini->getTransactionStatus('INV123');
if($status['success']) {
    echo "Status: {$status['data']['status']}";
}
Handle Callback
php
Copy
$callback = Paydisini::handleCallback($apiKey, $_POST);
if($callback['success']) {
    // Update status transaksi di database
    $status = $callback['data']['status'];
    $amount = $callback['data']['amount'];
    // ... proses update
}
header('Content-Type: application/json');
echo json_encode(['success' => true]);
        }
    },
    "license": "MIT",
    "authors": [
        {
            "name": "Your Name",
            "email": "your.email@example.com"
        }
    ]
}
Commit dan push perubahan ke GitHub:

bash
Copy
git add .
git commit -m "Initial commit: Paydisini PHP Library"
git push origin main
3. Publikasikan ke Packagist
Packagist adalah repository utama untuk library PHP yang bisa diinstall via Composer.

Buka Packagist dan login (gunakan akun GitHub).

Klik Submit di bagian atas.

Masukkan URL repository GitHub Anda, misalnya:

Copy
https://github.com/username/paydisini-php
Klik Check untuk memverifikasi repository.

Jika valid, klik Submit untuk mempublikasikan library.

4. Aktifkan Auto-Update (Opsional)
Agar Packagist otomatis update ketika ada perubahan di GitHub:

Buka halaman library Anda di Packagist.

Klik Settings.

Cari bagian GitHub Service Hook.

Klik Update untuk mengaktifkan auto-update.

5. Cara Menggunakan Library
Setelah library dipublikasikan, orang lain bisa menginstallnya via Composer:

Install library:

bash
Copy
composer require username/paydisini-php
Gunakan di proyek PHP:

php
Copy
require 'vendor/autoload.php';
use Paydisini\Paydisini;

$apiKey = 'API_KEY_ANDA';
$paydisini = new Paydisini($apiKey);

$channels = $paydisini->getPaymentChannels();
print_r($channels);
6. Tambahkan Dokumentasi
Pastikan file README.md di repository GitHub Anda jelas dan lengkap. Contoh:

markdown
Copy
# Paydisini PHP Library

Library PHP untuk integrasi Paydisini Payment Gateway.

## Instalasi

```bash
composer require username/paydisini-php
Penggunaan
php
Copy
require 'vendor/autoload.php';
use Paydisini\Paydisini;

$apiKey = 'API_KEY_ANDA';
$paydisini = new Paydisini($apiKey);

// Mendapatkan channel pembayaran
$channels = $paydisini->getPaymentChannels();
if($channels['success']) {
    foreach($channels['data'] as $channel) {
        echo "{$channel['name']} - Fee: {$channel['fee']}\n";
    }
}
Dokumentasi Lengkap
Lihat dokumentasi resmi Paydisini untuk detail lebih lanjut.

Copy

---

### **7. Tambahkan Tag Versi (Opsional)**
Untuk mengelola versi library, Anda bisa membuat tag Git:
1. Buat tag versi:
   ```bash
   git tag 1.0.0
   git push origin 1.0.0
Packagist akan otomatis mendeteksi versi baru.

8. Promosikan Library
Bagikan link repository GitHub dan Packagist di forum atau komunitas PHP.

Tambahkan badge di README.md untuk menampilkan informasi seperti versi, status build, dll. Contoh:

markdown
Copy
![Latest Version](https://img.shields.io/packagist/v/username/paydisini-php)
![License](https://img.shields.io/packagist/l/username/paydisini-php)
Dengan langkah-langkah di atas, library PHP Anda sudah bisa diakses oleh siapa saja via Composer! 🚀

New chat
Message DeepSeek
