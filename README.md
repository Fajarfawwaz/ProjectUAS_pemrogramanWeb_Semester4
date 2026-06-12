# E-Library System - UAS Pemrograman Web 2

Repositori ini berisi sistem informasi pengelolaan data buku (E-Library) yang dikembangkan untuk memenuhi tugas akhir mata kuliah Pemrograman Web 2. Proyek ini menggunakan arsitektur **Decoupled** dengan pemisahan penuh antara *Backend API* dan *Frontend SPA*.

## 👤 Identitas Mahasiswa
* **Nama**: Fajar Fawwaz Atallah
* **NIM**: 312410357
* **Kelas**: I241D / TI.24.A4
* **Matkul**: PEMROGRAMAN WEB

## 🏗️ Struktur Proyek
* `backend-api/`: RESTful API Server dibangun dengan CodeIgniter 4, menerapkan fitur keamanan JWT (JSON Web Token).
* `frontend-spa/`: Frontend Single Page Application (SPA) dibangun dengan VueJS 3, TailwindCSS (Ultra-Modern UI), dan Axios untuk komunikasi API.

## 🖼️ Dokumentasi Visual & Pengujian

### 1. Skema Relasi Database
<img width="600" height="223" alt="image" src="https://github.com/user-attachments/assets/451ab840-e6d0-47de-8d12-cf75f09657e2" />

*Lampiran: Visualisasi relasi tabel (users, kategori, buku) pada database.*

### 2. Uji Coba Keamanan API (Backend)
<img width="509" height="374" alt="Screenshot 2026-06-12 104902" src="https://github.com/user-attachments/assets/ebcea66b-39ce-490c-9a08-e84eba62035d" />

*Lampiran: Pengujian endpoint `POST` pada Postman tanpa token. Sistem berhasil memblokir akses dan mengembalikan status **401 Unauthorized** sebagai bukti `AuthFilter` bekerja dengan baik.*

### 3. Antarmuka Aplikasi (Frontend)
* **Halaman Login**:

<img width="800" alt="image" src="https://github.com/user-attachments/assets/2f2227ea-6834-4cc8-a4a4-036e85b08c14" />

* **Dashboard Admin**:

<img width="800" alt="image" src="https://github.com/user-attachments/assets/19b1885f-4ada-446c-887d-a366aa639ba0" />

<img width="800" alt="image" src="https://github.com/user-attachments/assets/245ef2ea-8abe-42aa-8ded-a0879aed901f" />

* **Tabel Data**:

<img width="800" alt="image" src="https://github.com/user-attachments/assets/05132daa-afe3-473f-9657-8383b0c2c50d" />

*Antarmuka mengimplementasikan konsep Glassmorphism dan desain Ultra-Modern.*

## 🚀 Petunjuk Instalasi & Menjalankan

### Backend
1. Masuk ke folder `backend-api/`.
2. Salin file `.env` dan atur konfigurasi database serta `JWT_SECRET_KEY`.
3. Jalankan server lokal:
```bash
   php spark serve
```

### Frontend

1. Masuk ke folder frontend-spa/.

2. Buka index.html menggunakan browser atau jalankan melalui live server lokal.

3. Pastikan API backend berjalan di ``` http://localhost:8080 ``` agar Axios dapat terhubung dengan sukses.

## 🔗 Presentasi

* **Video Presentasi**: https://youtu.be/h1v2-FyxK3k?si=VOclIW_v_WjoJG05
