<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CobrosController extends Controller
{
    public function index(){
        return view('cobros.menu');
    }
}
