<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        
        // 1. Validasi keberadaan header Authorization
        if (!$header || !preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['status' => 401, 'error' => 'Akses ditolak: Token tidak ditemukan.']);
        }

        $token = $matches[1];
        
        // 2. Gunakan env() untuk keamanan kunci rahasia
        // Pastikan Anda sudah menambahkan JWT_SECRET_KEY di file .env Anda
        $key = env('JWT_SECRET_KEY', 'default_kunci_rahasia_untuk_dev');

        try {
            // 3. Dekode dan validasi token
            JWT::decode($token, new Key($key, 'HS256'));
        } catch (Exception $e) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['status' => 401, 'error' => 'Akses ditolak: Token tidak valid atau kedaluwarsa.']);
        }

        return; // Lanjut ke Controller
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi tambahan
    }
}