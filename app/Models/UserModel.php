<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Menentukan tabel database yang digunakan
    protected $table = 'users';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'id';

    // Menentukan kolom mana saja yang boleh diisi (mass assignment)
    // Field 'role' disertakan agar bisa diset otomatis saat registrasi
    protected $allowedFields = ['username', 'password', 'role'];

    // Opsional: Jika ingin menggunakan timestamps (created_at, updated_at)
    // Pastikan kolom tersebut sudah ada di tabel 'users' Anda
    protected $useTimestamps = false;
}