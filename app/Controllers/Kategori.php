<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KategoriModel; // Lebih rapi menggunakan 'use'

class Kategori extends ResourceController 
{
    // Memastikan output selalu JSON
    protected $format = 'json';

    public function index() 
    {
        $model = new KategoriModel();
        return $this->respond($model->findAll());
    }
}