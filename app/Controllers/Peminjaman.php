<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PeminjamanModel;

class Peminjaman extends ResourceController
{
    protected $format = 'json';

    // 1. Menampilkan semua data peminjaman (untuk Admin)
    public function all()
    {
        $db = \Config\Database::connect();
        // Melakukan JOIN ke tabel buku dan users agar admin bisa melihat detail lengkap
        $data = $db->table('peminjaman')
            ->select('peminjaman.*, buku.judul, users.username')
            ->join('buku', 'buku.id = peminjaman.book_id')
            ->join('users', 'users.id = peminjaman.user_id')
            ->orderBy('peminjaman.id', 'DESC')
            ->get()
            ->getResultArray();
            
        return $this->respond($data);
    }

    // 2. Membuat peminjaman dengan validasi
    public function create()
    {
        $model = new PeminjamanModel();
        $data = $this->request->getJSON(true);
        
        // Validasi: Cek apakah buku sudah dipinjam
        $existing = $model->where('book_id', $data['book_id'])
                          ->where('status', 'dipinjam')
                          ->first();
                          
        if ($existing) {
            return $this->fail('Buku ini sedang tidak tersedia (sudah dipinjam).', 400);
        }

        // Data peminjaman
        $data['tanggal_pinjam'] = date('Y-m-d');
        $data['status']         = 'dipinjam';
        
        if ($model->insert($data)) {
            return $this->respondCreated(['message' => 'Buku berhasil dipinjam']);
        }
        return $this->fail('Gagal memproses peminjaman');
    }

    // 3. Fungsi Pengembalian Buku
    public function returnBook($id = null)
    {
        $model = new PeminjamanModel();
        
        // Pastikan data peminjaman ada
        if (!$model->find($id)) {
            return $this->failNotFound('Data peminjaman tidak ditemukan');
        }

        // Update status menjadi 'dikembalikan'
        if ($model->update($id, ['status' => 'dikembalikan'])) {
            return $this->respond(['message' => 'Buku berhasil dikembalikan']);
        }
        
        return $this->fail('Gagal memperbarui status pengembalian');
    }

    // 4. Menampilkan riwayat peminjaman spesifik per user
    public function userHistory($user_id = null)
    {
        $db = \Config\Database::connect();
        
        // Mengambil data peminjaman JOIN dengan buku untuk menampilkan judulnya
        $data = $db->table('peminjaman')
            ->select('peminjaman.*, buku.judul')
            ->join('buku', 'buku.id = peminjaman.book_id')
            ->where('peminjaman.user_id', $user_id)
            ->orderBy('peminjaman.id', 'DESC')
            ->get()
            ->getResultArray();
            
        return $this->respond($data);
    }
}