<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    // Nama tabel di database
    protected $table            = 'buku';
    
    // Primary key tabel
    protected $primaryKey       = 'id';
    
    // Fitur auto-increment
    protected $useAutoIncrement = true;
    
    // Format return data
    protected $returnType       = 'array';
    
    // Kolom yang diizinkan untuk diisi melalui form atau API
    protected $allowedFields    = ['judul', 'kategori_id', 'penulis', 'penerbit'];

    // Opsional: Untuk menambah timestamp otomatis (pastikan tabel punya kolom created_at & updated_at)
    protected $useTimestamps    = false; 
}