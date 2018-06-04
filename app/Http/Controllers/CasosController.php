<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CasosController extends Controller
{
    public function index(){
        return view('casos.menu');
    }
}
