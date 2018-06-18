<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AgendaController extends Controller
{
    //Devolución de la página principal
    public function index(){
        return view('agenda.agenda');
    }
}
