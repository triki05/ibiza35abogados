<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProcuradoresController extends Controller
{
    public function index(){
        return view('procuradores.menu');
    }
}
