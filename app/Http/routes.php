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
    
    Route::get('/menu-cobros','CobrosController@index');
    
    Route::get('/agenda','AgendaController@index');
    
    Route::get('/municipios/{id}','ProvinciasController@getMunicipios');
    
    //Clientes
    Route::get('/menu-clientes', 'ClientesController@index');
    
    Route::get('/menu-clientes/nuevo',array(
        "as" => "nuevoCliente",
        "uses" => "ClientesController@newCliente"
    ));
    
    Route::post('/menu-clientes/nuevo/guardar',array(
        'as' => 'save-cliente',
        'uses' => 'ClientesController@saveCliente'
    ));
    
    Route::get('/menu-clientes/listado',array(
        'as' => 'list-customers',
        'uses' => 'ClientesController@listClientes'
    ));
    
    //Contrarios
    Route::get('/menu-contrarios','ContrariosController@index');
    
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
    
    //Tribunales
    Route::get('/menu-tribunales', 'TribunalesController@index');
    
    Route::get('/menu-tribunales/nuevo',array(
        "as" => "nuevoTribunal",
        "uses" => "TribunalesController@newTribunal"
    ));
    
    Route::post('/menu-tribunales/nuevo/guardar',array(
        'as' => 'save-tribunal',
        'uses' => 'TribunalesController@saveTribunal'
    ));
    
    Route::get('/menu-tribunales/listado',array(
        'as' => 'list-tribunales',
        'uses' => 'TribunalesController@listTribunales'
    ));
    
    //Procuradores
    Route::get('/menu-procuradores','ProcuradoresController@index');
    
    Route::get('/menu-procuradores/nuevo',[
        'as' => 'nuevo-procurador',
        'uses' => 'ProcuradoresController@nuevo'
    ]);
    
    Route::post('/menu-procuradores/nuevo/guardar',[
        'as' => 'save-procurador',
        'uses' => 'ProcuradoresController@guardar'
    ]);
    
    Route::get('/menu-procuradores/listado',[
        'as' => 'list-procuradores',
        'uses' => 'ProcuradoresController@listar'
    ]);
    
    
    //Casos
    Route::get('/menu-casos','CasosController@index');
    
    Route::get('/menu-casos/nuevo',[
        'as' => 'new-case',
        'uses' => 'CasosController@nuevo'
    ]);
    
    Route::post('/menu-casos/nuevo/guardar',[
        'as' => 'save-case',
        'uses' => 'CasosController@guardar'
    ]);
    
    Route::get('/menu-casos/listar',[
        'as' => 'list-case',
        'uses' => 'CasosController@listar'
    ]);
    
    Route::get('/menu-casos/periciales',[
        'as' => 'list-periciales',
        'uses' => 'CasosController@listarPericiales'
    ]);
    
    Route::get('/menu-casos/turno-oficio',[
        'as' => 'list-turno-oficio',
        'uses' => 'CasosController@listarTurnoOficio'
    ]);
    
    Route::get('/menu-casos/caso/{caso_id}',[
        'as' => 'caso',
        'uses' => 'CasosController@caso'
    ]);
});