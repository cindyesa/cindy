# Sistem Manajemen Poliklinik

- Pasien
username: Adi
pass: Semarang
- Dokter
username: Ifan
pass: Semarang
- Admin (LOGIN VIA DOKTER)
username: Admin
pass: admin

## Fitur-fitur

**Mengelola Dokter**
1. Sebagai seorang Admin, saya ingin mengelola data dokter seperti menambah data dokter termasuk menentukan di poli mana dokter tersebut bekerja, mengubah data dokter dan menghapus data dokter, sehingga dapat memudahkan saya untuk mengelola data dokter
**Mengelola Poli**
2. Sebagai seorang Admin, saya ingin mengelola data poli meliputi menambah data poli, mengubah data poli dan menghapus data poli, sehingga dapat memudahkan saya untuk mengelola data poli.
**Mendaftar Poli**
3. Sebagai seorang Pasien, saya ingin mendaftar ke poli sesuai keluhan / gejala yang saya rasakan. Saat mendaftar poli saya ingin memilih dokter dan melihat jadwal prakteknya. Setelah saya mendaftar poli, saya ingin mendapatkan nomer antrian. Sehingga saya dapat mengatur waktu saya untuk berangkat ke poli
**Melakukan Pendaftaran Pasien**
4. Sebagai seorang Pasien, saya ingin mendaftar sebagai pasien poliklinik. Saya bersedia menginformasikan data diri saya, sehingga saya memenuhi persyaratan sebagai seorang pasien dan mendapat no rekam medis.
**Memeriksa Pasien**
5. Sebagai seorang Dokter, saya ingin mempunyai sistem yang dapat menginformasikan daftar pasien yang akan saya periksa, menuliskan catatan kesehatan pasien dan memberikan obat-obatan apa diperlukan. Sehingga akan mempermudah bagi saya untuk mengetahui riwayat pemeriksaan pasien.
**Mengelola Obat**
6. Sebagai seorang Admin, saya ingin mengelola data obat meliputi menambah data obat, mengubah data obat dan menghapus data obat, sehingga dapat memudahkan saya untuk mengelola data obat.
**Login sbg Admin**
7. Sebagai seorang Admin, saya ingin memiliki suatu privilege untuk dapat mengelola data dokter, pasien, obat dan poli serta Dashboard untuk menampilkan jumlah poli, dokter, dan pasien. Sehingga mempermudah pekerjaan saya.
**Memberikan Catatan Obat**
8. Sebagai seorang Dokter, saya ingin memberikan catatan obat-obatan yang diperlukan bagi pasien saya. Sehingga akan mempermudah bagi saya untuk menelusuri obat-obatan apa saja yang pernah diberikan.
**Menghitung Biaya Periksa**
9. Sebagai seorang Dokter, saya ingin mengetahui biaya periksa (termasuk obatobatan yang diperlukan) bagi pasien. Sehingga apabila pasien keberatan dengan biaya yang muncul, saya dapat mengatur obat (misalkan mengurangi atau menggantinya dengan yang lebih murah).
**Login sbg Dokter**
10. Sebagai seorang Dokter, saya ingin memiliki suatu privilege untuk dapat mengetahui daftar pasien yang akan saya periksa, mengatur waktu periksa saya, dan riwayat pasien yang telah saya periksa. Sehingga akan mempermudah saya daam mengelola pekerjaan saya.
**Mengelola Pasien**
11. Sebagai seorang Admin, saya ingin memiliki akses untuk dapat mengelola data pasien meliputi menambah (walaupun pasien dapat melakukan registrasi pasien), mengedit pasien dan menghapus pasien. Sehingga akan mempermudah pekerjaan saya untuk mengelola data pasien.
**Input Ketersediaan Jadwal Pariksa**
12. Sebagai seorang Dokter, saya ingin mengatur waktu janjian saya dengan pasien yang akan periksa ke saya. Sehingga pasien yang akan periksa ke saya memiliki potensi / kesempatan yang lebih besar untuk dapat bertemu dengan saya.
**Memperbaharui Data Dokter**
13. Sebagai seorang Dokter, saya ingin memperbaharui data diri saya seperti memperbaharui nama dan gelar saya, dapat memperbaharui password saya login, dan poli dimana saya melakukan pemeriksaan. Sehingga akan mempermudah
pekerjaan saya untuk mengelola data pasien.
**Menampilkan Riwayat Pasien**
14. Sebagai seorang Dokter, saya ingin mengetahui riwayat pasien yang telah saya periksa. Sehingga akan mempermudah pekerjaan saya untuk melakukan pemeriksaan pasien.
## Teknologi yang Digunakan

- **PHP**: Pengembangan backend menggunakan PHP untuk logika sisi server.

- **MySQL**: Manajemen database untuk menyimpan informasi pasien, janji, dan rekam medis.

- **HTML, CSS, JavaScript**: Pengembangan frontend untuk antarmuka yang ramah pengguna.

- **Bootstrap**: Digunakan untuk desain responsif dan menarik secara visual.

## Instalasi

1. Klon repository: `link git nya.................`

2. Siapkan server web (misalnya, Apache) dan konfigurasikan agar menunjuk ke direktori publik proyek.

3. Impor skema database dari `bk_poliklinik1` ke database MySQL Anda.

4. Konfigurasi koneksi database pada `config/conn.php`.

5. Buka aplikasi di browser web Anda dan buat akun admin untuk memulai.

## Penggunaan

1. Buka URL aplikasi.

2. Masuk dengan kredensial admin yang disediakan.

3. Jelajahi modul-modul berbeda untuk registrasi pasien, penjadwalan janji, rekam medis, billing, dan pelaporan.

4. Sesuaikan pengaturan sistem sesuai kebutuhan.



## Pengakuan

- Terima kasih khusus kepada [Bootstrap](https://getbootstrap.com/) atas menyediakan kerangka desain responsif.

- Ikon dibuat oleh [Freepik](https://www.freepik.com) dari [www.flaticon.com](https://www.flaticon.com/).

--- 
