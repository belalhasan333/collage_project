<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // athoba jekono view return korte paro
    }
    public function accounts(){
        return view('auth.login');
    }
}
