<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Book extends ResourceController
{
    protected $modelName = 'App\Models\BookModel';
    protected $format    = 'json';

    public function index()
    {
        // Menggunakan JOIN ke tabel kategori DAN tabel peminjaman
        // Kita gunakan status='dipinjam' sebagai filter agar hanya buku yang sedang dipinjam yang terdeteksi
        $db = \Config\Database::connect();
        
        $data = $db->table('buku')
            ->select('buku.*, kategori.nama_kategori, peminjaman.status as status_pinjam')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->join('peminjaman', 'peminjaman.book_id = buku.id AND peminjaman.status = "dipinjam"', 'left')
            ->get()
            ->getResultArray();
                            
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $db = \Config\Database::connect();
        
        $data = $db->table('buku')
            ->select('buku.*, kategori.nama_kategori, peminjaman.status as status_pinjam')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->join('peminjaman', 'peminjaman.book_id = buku.id AND peminjaman.status = "dipinjam"', 'left')
            ->where('buku.id', $id)
            ->get()
            ->getRowArray();
                            
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Data buku dengan ID ' . $id . ' tidak ditemukan.');
    }

    // ... (Fungsi create, update, dan delete tetap sama seperti kode Anda sebelumnya)
    public function create()
    {
        $data = $this->request->getJSON(true);
        if (empty($data)) { return $this->fail('Data input tidak boleh kosong'); }
        $rules = [
            'judul'       => 'required|min_length[3]',
            'penulis'     => 'required',
            'kategori_id' => 'required|is_natural_no_zero'
        ];
        if (!$this->validate($rules)) { return $this->fail($this->validator->getErrors()); }
        if ($this->model->insert($data)) { return $this->respondCreated(['message' => 'Buku berhasil ditambahkan']); }
        return $this->fail($this->model->errors());
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->find($id)) { return $this->failNotFound('Data tidak ditemukan'); }
        if ($this->model->update($id, $data)) { return $this->respond(['message' => 'Data buku berhasil diupdate']); }
        return $this->fail($this->model->errors());
    }

    public function delete($id = null)
    {
        if ($this->model->find($id)) {
            $this->model->delete($id);
            return $this->respondDeleted(['message' => 'Data buku berhasil dihapus']);
        }
        return $this->failNotFound('Data buku tidak ditemukan');
    }
}