<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // --- TAMBAHAN UNTUK CORS ---
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

        // Jika request adalah OPTIONS (preflight), kirim response kosong dan hentikan eksekusi
        if ($request->getMethod() === 'options') {
            exit;
        }
        // --- AKHIR TAMBAHAN ---

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);
    }
}