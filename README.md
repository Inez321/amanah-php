# 💧 AMANAH - Sistem Manajemen Depot Air Minum

**Kelompok B5**  
[Huriyyahul Asma Astie] - [23080960059]  
[Faza Amalia Rizqi] - [23080960063]  
[Inez Nurdika Irzani] - [23080960064] 

## 📌 Deskripsi Proyek
AMANAH adalah sistem manajemen depot air minum yang dibangun dengan teknologi web untuk memudahkan operasional bisnis distribusi air galon. Aplikasi ini menyediakan solusi digital untuk:

- 📊 **Manajemen Stok Real-time**  
  Memantau ketersediaan galon (isi/kosong) dan produk lainnya
- 🚛 **Pelacakan Distribusi**  
  Pencatatan lengkap proses pengiriman ke pelanggan
- ♻️ **Ekosistem Galon Berkelanjutan**  
  Sistem pengembalian galon kosong yang terintegrasi
- 💻 **Antarmuka Admin Modern**  
  Dashboard intuitif dengan visualisasi data

## 🚀 Fitur Utama
| Fitur | Deskripsi |
|-------|-----------|
| **Manajemen Produk** | CRUD data produk (Galon 19L, Botol 600ml) |
| **Tracking Galon** | Status real-time (Ada isi/Kosong/Tersedia) |
| **Restock Otomatis** | Generate kode item unik (ITM-000001) | 
| **Return Galon** | Pencatatan pengembalian + status update |
| **Laporan Stok** | Monitoring inventori real-time |

## 🛠️ Stack Teknologi
- **Backend**: PHP 
- **Database**: MySQL
- **Frontend**: HTML,  CSS, JavaScript
- **FrameWork CSS**: Bootstrap
- **Tools lain**: Laragon, Git/GitHub

## 🔧 Panduan Instalasi
### Langkah Implementasi
1. **Clone Repository**
   ```bash
   git clone https://github.com/Inez321/amanah-php.git
   cd amanah-water

2. **Setup Database**
   ```sql
   CREATE DATABASE amanah_db;
   USE amanah_db;

3. **Konfigurasi Environment**

   Edit file `helper/connection.php`:
   ```php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $database = 'amanah_db';
   $conn = new mysqli($host, $user, $password, $database);

5. **Akses Aplikasi**
   ```bash
   http://localhost/amanah-php/

   Default Credentials:
   Admin: admin1@gmail.com | Pass: 123


