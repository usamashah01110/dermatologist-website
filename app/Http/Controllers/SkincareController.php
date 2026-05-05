<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkincareController extends Controller
{
    public function index()
    {
        return view('skincare');
    }

      public function skincaredetail()
    {
        return view('skincare-detail');
    }
}
