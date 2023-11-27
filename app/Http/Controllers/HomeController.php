<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $pageTitle = 'home'; 
        return view('home', [
            'pageTitle'=> $pageTitle,
        ]);
        
    }
}
