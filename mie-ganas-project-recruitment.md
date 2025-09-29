# Project Recruitment: Developer Fullstack
## Aplikasi Pemesanan "Mie Ganas"

---

## 📋 Overview Project
Aplikasi pemesanan makanan berbasis web untuk restoran Mie Ganas dengan sistem multi-role (Customer, Admin, Kasir, Pelayan) yang terintegrasi dengan payment gateway dan tracking order real-time.

---

## 🛠 Tech Stack Requirements

### Backend & Frontend
- **Framework**: Laravel 12
- **Frontend**: Blade Template + Vanilla JavaScript / Alpine.js
- **CSS Framework**: Tailwind CSS / Bootstrap 5

### Database
- **Primary Options**: 
  - PostgreSQL 14+ (Recommended), atau
  - MySQL 8.0+

### Payment Gateway
- **Midtrans**: QRIS Payment Integration
  - Snap Payment Gateway
  - Core API untuk QRIS

### Push Notification
- **Rekomendasi Teknologi**:
  - **Firebase Cloud Messaging (FCM)** - Free tier tersedia
  - **Pusher** - Real-time notification
  - **Laravel Echo + Pusher/Socket.io** - WebSocket based
  - **OneSignal** - Free untuk unlimited devices

### Additional Tools
- **QR Code Generator**: SimpleSoftwareIO/simple-qrcode atau endroid/qr-code
- **Barcode Scanner**: HTML5 QR Code Scanner (JavaScript)
- **Thermal Printer**: escpos-php untuk cetak struk
- **Real-time Updates**: Laravel Broadcasting + Pusher/Socket.io

---

## 👥 User Roles & Features

### 1️⃣ PELANGGAN (Customer)

#### A. Authentication & Onboarding
- ✅ Scan barcode QR untuk akses (tanpa registrasi manual)
- ✅ Auto-login via unique session dari QR code
- ✅ QR Code mengarah ke URL: `https://mieganas.app/table/{table_number}/{session_id}`

#### B. Browse Menu
- ✅ Tampilan grid/list menu dengan foto
- ✅ Detail menu mencakup:
  - Foto produk (high quality)
  - Nama menu
  - Harga
  - Status ketersediaan (available(muncul berwarna bisa di klik)/sold out(abu- abu tidak bisa di klik/ jika di klik muncul tulisan maaf, menu sudah habis))
- ✅ Filter berdasarkan kategori (Mie, Minuman, Snack, dll)
- ✅ Search menu

#### C. Keranjang (Cart)
- ✅ Tambah/kurang quantity
- ✅ Catatan khusus per item (contoh: "tanpa bawang")
- ✅ Subtotal otomatis
- ✅ Tampilkan total harga + pajak (jika ada)

#### D. Checkout & Payment
- ✅ Pilihan metode pembayaran:
  - **QRIS** (via Midtrans) - langsung bayar
  - **Bayar Manual di Kasir** - buat order dulu, bayar nanti
- ✅ Konfirmasi order sebelum checkout
- ✅ Generate nomor order unik

#### E. Tracking Order
- ✅ Status real-time:
  - "Menunggu Pembayaran" (jika bayar manual)
  - "Sedang Diproses" (setelah bayar/konfirmasi kasir)
  - "Sedang Disiapkan"
  - "Siap Diantar"
  - "Selesai"
- ✅ Estimasi waktu tunggu
- ✅ Push notification saat status berubah

#### F. History Order
- ✅ Daftar riwayat pemesanan
- ✅ Detail order (items, total, tanggal, status)
- ✅ Opsi re-order dari history

#### G. Thank You Page
- ✅ Halaman terima kasih setelah order selesai
- ✅ Rating & review (optional)

---

### 2️⃣ ADMIN/OWNER

#### A. Authentication
- ✅ Login dengan email & password
- ✅ Role-based access control

#### B. Dashboard Analytics
- ✅ **Penjualan Harian**:
  - Total transaksi
  - Total pendapatan
  - Grafik penjualan per jam
  - Menu terlaris hari ini
- ✅ **Penjualan Mingguan**:
  - Grafik trend per hari
  - Perbandingan minggu sebelumnya
  - Menu terlaris minggu ini
- ✅ **Penjualan Bulanan**:
  - Grafik trend per minggu
  - Revenue bulanan
  - Total order selesai
  - Menu terlaris bulan ini
- ✅ **Metrics**:
  - Average Order Value (AOV)
  - Jumlah customer unik
  - Payment method distribution (QRIS vs Manual)

#### C. CRUD Menu
- ✅ **Create**: 
  - Upload foto menu (max 2MB)
  - Nama, harga
  - Kategori
  - Status (available/unavailable)
- ✅ **Read**: Daftar semua menu dengan thumbnail
- ✅ **Update**: Edit semua informasi menu
- ✅ **Delete**: Soft delete menu
- ✅ Bulk actions (enable/disable multiple items)

#### D. Manajemen Kategori
- ✅ CRUD kategori menu
- ✅ Urutan tampilan kategori

#### E. Laporan
- ✅ Export data penjualan (Excel/PDF)
- ✅ Filter by date range
- ✅ Laporan per menu
- ✅ Laporan per kasir

#### F. Settings
- ✅ Konfigurasi pajak/service charge
- ✅ Generate QR Code untuk meja
- ✅ Manajemen user (kasir, pelayan)

---

### 3️⃣ KASIR

#### A. Authentication
- ✅ Login kasir (username & password)

#### B. Point of Sale (POS)
- ✅ **Terima pembayaran manual**:
  - Lihat detail order dari customer
  - Input jumlah uang diterima
  - Hitung kembalian otomatis
  - Konfirmasi pembayaran
- ✅ **Buat order langsung** (walk-in customer):
  - Pilih menu
  - Input quantity
  - Checkout langsung

#### C. Cetak Struk
- ✅ Print thermal receipt otomatis setelah pembayaran
- ✅ Format struk mencakup:
  - Logo & nama restoran
  - Nomor order
  - Tanggal & waktu
  - Daftar item + harga
  - Subtotal, pajak, total
  - Nama kasir
  - Terima kasih message

#### D. Riwayat Transaksi
- ✅ Lihat transaksi hari ini
- ✅ Reprint struk jika diperlukan

#### E. Cash Management (Opsional)
- ✅ Laporan kas harian
- ✅ Opening/closing balance

---

### 4️⃣ PELAYAN (Waiter/Waitress)

#### A. Authentication
- ✅ Login pelayan

#### B. Order Tracking Dashboard
- ✅ **Real-time order list**:
  - Semua order yang masuk
  - Filter by status
  - Filter by table number
- ✅ **Update status order**:
  - Ubah status dari "Sedang Diproses" → "Sedang Disiapkan" → "Siap Diantar" → "Selesai"
  - Button action untuk update status
- ✅ **Notifikasi**:
  - Sound/visual alert saat ada order baru
  - Highlight order yang sudah terlalu lama (lebih dari 15 menit)

#### C. Table Management
- ✅ Lihat status meja (occupied/available)
- ✅ Detail order per meja

---

## 🔐 Security Requirements

- ✅ Authentication menggunakan Laravel Sanctum/Breeze
- ✅ CSRF Protection
- ✅ Input validation & sanitization
- ✅ Role-based middleware
- ✅ Secure payment handling (no card data stored)
- ✅ HTTPS required untuk production
- ✅ Rate limiting untuk API endpoints

---

## 📱 Responsive Design

- ✅ Mobile-first design (customer facing)
- ✅ Tablet-friendly untuk kasir & pelayan
- ✅ Desktop optimized untuk admin dashboard

---

## 🔔 Notification System

### Push Notification Events:
1. **Customer**: 
   - Order confirmed
   - Status order berubah
   - Order siap diantar
2. **Pelayan**:
   - Order baru masuk
   - Pembayaran dikonfirmasi
3. **Admin/Owner**:
   - Daily sales summary

---

## 🧪 Testing Requirements

- Unit testing untuk business logic
- Feature testing untuk CRUD operations
- Payment gateway testing (sandbox mode)
- Browser testing (Chrome, Firefox, Safari)

---

## 📦 Deliverables

1. **Source Code**: 
   - Clean, documented code
   - Git repository dengan commit history yang baik
2. **Database**:
   - Migration files
   - Seeder untuk sample data
3. **Documentation**:
   - API documentation (jika ada)
   - User manual (Admin, Kasir, Pelayan)
   - Installation guide
4. **Deployment**:
   - Aplikasi ter-deploy di staging server
   - ENV configuration guide

---

## ⏱ Estimasi Timeline

- **Phase 1** (2-3 minggu): Setup, Authentication, Menu Management
- **Phase 2** (2-3 minggu): Cart, Checkout, Payment Integration
- **Phase 3** (2 minggu): Order Tracking, POS System, Receipt Printing
- **Phase 4** (1-2 minggu): Dashboard Analytics, Reports
- **Phase 5** (1 minggu): Testing, Bug Fixing, Documentation

**Total**: 8-11 minggu

---

## 💰 Budget Consideration

- Developer Fullstack Laravel: berdasarkan rate & lokasi
- Third-party services:
  - Midtrans: Transaction fee ~0.7%
  - Push Notification: FCM (Free) / Pusher (~$49/mo)
  - Hosting: VPS (~$10-50/mo tergantung spesifikasi)

---

## 📞 Contact & Application

Kirim CV dan portfolio ke: **[email-perusahaan]**

Subject: **"Fullstack Developer - Mie Ganas Project"**

Include:
- Portfolio Laravel projects
- GitHub profile
- Pengalaman dengan payment gateway
- Availability & expected rate

---

## ❓ FAQ untuk Kandidat

**Q: Apakah bisa dikerjakan remote?**  
A: [Sesuaikan dengan kebutuhan]s

**Q: Apakah ini project contract atau full-time?**  
A: [Sesuaikan dengan kebutuhan]

**Q: Tech stack bisa dimodifikasi?**  
A: Bisa diskusi untuk alternatif yang setara atau lebih baik

---

*Document version 1.0 - Created for Mie Ganas Project Recruitment*