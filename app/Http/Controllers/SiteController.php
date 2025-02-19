<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('layouts.app');
    }

    public function dashboard()
    {
        return view('layouts.app');
    }
}
