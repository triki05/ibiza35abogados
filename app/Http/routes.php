<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if(Auth::user()){
        return view('home');
    }else{
        return view('welcome');
    }
});

Route::auth();

Route::group(['middleware'=>['auth']],function(){
    
    Route::get('/home', 'HomeController@index');
    Route::get('/menu-clientes', 'ClientesController@index');
    Route::get('/menu-contrarios','ContrariosController@index');
    Route::get('/menu-tribunales', 'TribunalesController@index');
    Route::get('/menu-procuradores','ProcuradoresController@index');
    Route::get('/menu-casos','CasosController@index');
    Route::get('/menu-cobros','CobrosController@index');
    Route::get('/agenda','AgendaController@index');
    Route::get('/menu-clientes/nuevo',array(
        "as" => "nuevoCliente",
        "uses" => "ClientesController@newCliente"
    ));
    Route::get('/municipios/{id}','ProvinciasController@getMunicipios');
    Route::post('/menu-clientes/nuevo/guardar',array(
        'as' => 'save-cliente',
        'uses' => 'ClientesController@saveCliente'
    ));
    Route::get('/menu-clientes/listado',array(
        'as' => 'list-customers',
        'uses' => 'ClientesController@listClientes'
    ));
    Route::get('/menu-contrarios/nuevo',array(
        'as' => 'nuevoContrario',
        'uses' => 'ContrariosController@newContrario'
    ));
    Route::post('/menu-contrarios/nuevo/guardar',array(
        'as' => 'save-contrario',
        'uses' => 'ContrariosController@saveContrario'
    ));
    Route::get('/menu-contrarios/listado',array(
        'as' => 'list-contrarios',
        'uses' => 'ContrariosController@listContrarios'
    ));
    
    Route::get('/menu-tribunales/nuevo',array(
        "as" => "nuevoTribunal",
        "uses" => "TribunalesController@newTribunal"
    ));
});

