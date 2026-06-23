<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Rute Auth (Publik)
$routes->post('auth/login', 'Auth::login');
$routes->post('auth/register', 'Auth::register');

// Rute Kategori (Publik - atau ganti ke authFilter jika hanya admin)
$routes->get('kategori', 'Kategori::index');

// Rute Buku (Book)
$routes->get('book', 'Book::index');
$routes->get('book/(:num)', 'Book::show/$1');

// Rute Buku yang dilindungi JWT
$routes->post('book/create', 'Book::create', ['filter' => 'authFilter']);
$routes->post('book/update/(:num)', 'Book::update/$1', ['filter' => 'authFilter']);
$routes->delete('book/delete/(:num)', 'Book::delete/$1', ['filter' => 'authFilter']);

// Rute Peminjaman yang dilindungi JWT
$routes->post('peminjaman/create', 'Peminjaman::create', ['filter' => 'authFilter']);
$routes->post('peminjaman/return/(:num)', 'Peminjaman::returnBook/$1', ['filter' => 'authFilter']);

// Rute Peminjaman lainnya
$routes->get('peminjaman/all', 'Peminjaman::all', ['filter' => 'authFilter']); 
$routes->get('peminjaman/user/(:num)', 'Peminjaman::userHistory/$1', ['filter' => 'authFilter']);