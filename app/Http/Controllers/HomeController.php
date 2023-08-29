<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    public function home(){
        // dd(FacadesAuth::check());
        // dd(FacadesAuth::id());
        // dd(FacadesAuth::user()->name);
        return view("home");
    }

    public function contact(){
        return view("contact");
    }

    public function secretPage(){
        return view('secret');
    }
}
