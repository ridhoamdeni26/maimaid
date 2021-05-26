<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController; 

class getAllController extends ResourceController
{
    protected $format = 'json';
    public function index()
    {
        return view('handler/index');
    }

    public function createData()
    {
        return view('handler/create');
    }

    public function updateData($id)
    {

        return view('handler/update', $id);
    }
}