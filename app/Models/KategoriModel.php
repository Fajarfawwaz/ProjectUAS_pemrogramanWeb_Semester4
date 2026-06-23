<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';      // Nama tabel di database
    protected $primaryKey = 'id';            // Primary key tabel
    
    // Sesuaikan dengan nama kolom yang ada di tabel 'kategori' Anda
    // (Pastikan ada kolom 'id' dan 'nama_kategori')
    protected $allowedFields = ['nama_kategori'];
}