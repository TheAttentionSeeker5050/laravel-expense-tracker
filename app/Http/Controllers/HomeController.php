<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // return home view
    public function index()
    {
        return view('home');
    }
}
