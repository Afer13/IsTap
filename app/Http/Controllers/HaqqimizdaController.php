<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaqqimizdaController extends Controller
{
    public function index(){
        return view('haqqimizda');
    }
}
