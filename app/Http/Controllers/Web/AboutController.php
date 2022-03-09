<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $envAry = [
            'php 7.4',
            'Laravel 8',
            'bootstrap 5',
        ];

        $data = [
            'name' => 'Navigator',
            'pageTitle' => 'About',
            'envAry' => $envAry
        ];

        return view('web/about', $data);
    }
}
