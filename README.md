# API Member

Dokumentasi API untuk resource Member.

## Deskripsi

Aplikasi ini adalah API yang digunakan untuk mengelola data member, termasuk endpoint untuk mengambil data member dan dokumentasi API yang dapat diakses melalui Swagger UI.

## Fitur
- **Form CRUD Member** : Untuk melakuka crud data member melalui endpoint `/manage-members`.
- **API Endpoint untuk Member**: Menyediakan data member melalui endpoint `/api/member`.
- **Dokumentasi Swagger**: Dokumentasi API yang dapat diakses pada endpoint `/api/documentation`.
- **OpenAPI Specification**: API didefinisikan menggunakan OpenAPI (Swagger) untuk mempermudah pemahaman dan penggunaan API.

## Installasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi:

### 1. Clone Repository

Clone repository ini ke dalam komputer lokal Anda:

```bash
git clone https://github.com/akimrpl/api_user_laravel.git

Install Dependencies
Masuk ke direktori proyek dan install semua dependencies yang diperlukan:

cd repository
composer install

Salin .env.example Menjadi .env
Salin file .env.example menjadi file .env dan sesuaikan konfigurasi database dan pengaturan lainnya.

copy .env.example .env -> windows
cp .env.example .env -> linux / mcos

Generate Application Key
Setelah menyalin file .env, jalankan perintah berikut untuk menghasilkan aplikasi key:

php artisan key:generate

 Jalankan Migrasi Database
Jalankan migrasi untuk membuat tabel di database:

php artisan:migrate

Jalankan Aplikasi
Untuk menjalankan aplikasi, gunakan perintah berikut:

php artisan serve
Aplikasi akan dapat diakses di http://localhost:8000.
