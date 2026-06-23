<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use Firebase\JWT\JWT; // Tambahkan ini untuk menggunakan library JWT

class Auth extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        // Login menggunakan perbandingan teks biasa
        if ($user && ($password == $user['password'])) {
            
            // 1. Siapkan payload JWT
            $key = env('JWT_SECRET_KEY');
            $payload = [
                'iat' => time(),                     // Waktu pembuatan
                'exp' => time() + 3600,              // Kedaluwarsa dalam 1 jam
                'uid' => $user['id'],
                'role' => $user['role']
            ];

            // 2. Buat token
            $token = JWT::encode($payload, $key, 'HS256');

            // 3. Respon dengan menyertakan token
            return $this->respond([
                'status' => 200,
                'message' => 'Login berhasil',
                'token' => $token, // Token dikirim agar bisa digunakan di header Authorization
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ]
            ]);
        }

        return $this->failUnauthorized('Username atau password salah');
    }

    public function register()
    {
        $model = new UserModel();
        // Mengambil data dari request JSON
        $data = $this->request->getJSON(true);

        // Validasi dasar
        if (empty($data['username']) || empty($data['password'])) {
            return $this->fail('Username dan password wajib diisi');
        }

        // Cek apakah username sudah ada
        if ($model->where('username', $data['username'])->first()) {
            return $this->fail('Username sudah terdaftar!');
        }

        // Set role default menjadi 'user'
        $data['role'] = 'user';

        // Simpan ke database
        if ($model->insert($data)) {
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Registrasi berhasil, silakan login'
            ]);
        }

        return $this->fail('Gagal melakukan registrasi');
    }
}