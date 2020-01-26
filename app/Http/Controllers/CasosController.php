<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Personas;
use App\Http\Requests;
use App\Casos;
use App\CasosClientes;
use App\Documento;
use App\Tribunales;
use App\Fase;

class CasosController extends Controller
{
	//Devolución de la página principal
	public function index(){
		return view('casos.menu');
	}
	
	public function nuevo(){
		//Buscar en la tabla Personas los clientes para enviarselos a la vista
		$clientes = Personas::where(['tipo'=>'Cliente'])->get();
		
		//Devolver la vista para crear un nuevo caso
		return view('casos.new',[
			'clientes' => $clientes
		]);
	}
	
	public function guardar(Request $request){
		//Validación de los datos recibidos del formulario
		$this->validate($request,[
			'referencia' => 'required',
			'asunto' => 'required',
			'estado' => 'required',
			'fecha-creacion' => 'required',
			'codigo-encargo' => 'required',
			'categoria' => 'required',
			'jurisdiccion' => 'required',
			'cliente' => 'required'
		]);
		
		//Creación de los objetos necesarios
		$caso = new Casos();
		$casoCliente = new CasosClientes();
		$fase = new Fase();
		
		//Asignación de valores a la tabla y guardado
		$caso->referencia = $request->input('referencia');
		$caso->fechaCreacion = $request->input('fecha-creacion');
		$caso->jurisdiccion = $request->input('jurisdiccion');
		$caso->codigoEncargo = $request->input('codigo-encargo');
		$caso->asunto = $request->input('asunto');
		$caso->categoriaCliente = $request->get('categoria');
		$caso->estado = $request->get('estado');
		
		$caso->save();
		
		$casoCliente->casos_id = $caso->id;
		$casoCliente->clientes_id = \Crypt::decrypt($request->get('cliente'));
		$casoCliente->numeroFase = 1;
		
		$casoCliente->save();

		$fase->descriptor = $caso->referencia;
		$fase->codTribunal = Tribunales::first()->id;
		$fase->codProcurador = Personas::where(['tipo'=>'Procurador'])->first()->id;
		$fase->fecha_inicio = date('Y-m-d',time());
		$fase->fecha_creacion = date('Y-m-d',time());
		$fase->save();
		
		//Devolver la vista con un mensaje flash
		return redirect()->route('new-case')->with(['message'=>'Caso creado correctamente']);
	}
	
	public function listar(){
		//Búsqueda de los casos particulares
		$casos = Casos::where(['categoriaCliente'=>'particular'])->get();
		
		//Devolver la vista con los casos
		return view('casos.list',[
			'casos'=>$casos,
		]);
	}
	
	public function listarPericiales(){
		//Buscar los casos de periciales
		$casos = Casos::where(['categoriaCliente'=>'pericial'])->get();
		
		//Devolver la vista con los casos
		return view('casos.periciales',[
			'casos'=>$casos
		]);
	}
	
	public function listarTurnoOficio(){
		//Buscar los casos del turno de oficio
		$casos = Casos::where(['categoriaCliente'=>'turno-oficio'])->get();
		
		//Devolver la vista con los casos
		return view('casos.turno-oficio',[
			'casos' => $casos
		]);
	}
	
	public function caso($caso_id){
		//Encontrar el caso con el id pasado por parámetro
		$caso = Casos::find(\Crypt::decrypt($caso_id));
		
		//Obtener clientes, contrarios y procuradores de la tabla Personas
		$clientes = Personas::where(['tipo'=>'Cliente'])->get();
		$contrarios = Personas::where(['tipo'=>'Contrario'])->get();
		$procuradores = Personas::where(['tipo'=>'Procurador'])->get();
		$tribunales = Tribunales::all();
		$casosClientes = $caso->casosclientes()->paginate(1,['*'],'page');
		$fases = $caso->fases()->paginate(1,['*'],'fase');

		
		//Devolver la vista con el caso, clientes y contrarios
		return view('casos.caso',[
			'caso' => $caso,
			'clientes' => $clientes,
			'contrarios' => $contrarios,
			'procuradores' => $procuradores,
			'tribunales' => $tribunales,
			'casosClientes' => $casosClientes,
			'fases' => $fases,
		]);
	}

	public function viewDocuments($caso_id){
		$caso = Casos::find(\Crypt::decrypt($caso_id));

		return view('casos.documentos',[
			'caso' => $caso
		]);
	}
	
	//Funcion para actualizar un caso
	public function update($caso_id,Request $request){
		//Validación de datos recibidos del formulario
		$this->validate($request,[
			'referencia' => 'required',
			'asunto' => 'required',
			'estado' => 'required',
			'fecha-creacion' => 'required',
			'codigo-encargo' => 'required',
			'categoria' => 'required',
			'jurisdiccion' => 'required'
		]);
		
		//Encontrar el caso
		$caso = Casos::findOrFail(\Crypt::decrypt($caso_id));
		
		//Asignación de valores y actualización de la tabla
		$caso->referencia = $request->input('referencia');
		$caso->asunto = $request->input('asunto');
		$caso->jurisdiccion = $request->input('jurisdiccion');
		$caso->estado = $request->get('estado');
		$caso->codigoEncargo = $request->input('codigo-encargo');
		$caso->fechaCreacion = $request->input('fecha-creacion');
		$caso->categoriaCliente = $request->get('categoria');
		
		$caso->update();
		
		//Devolucion de una redirección a la vista del caso con los datos actualizados
		return redirect()->route('caso',['caso_id' => \Crypt::encrypt($caso->id)]);
	}
	
	//Actualización de la tabla intermedia CasosClientes
	public function updateCasoCliente($caso_id,Request $request){
		//Validación de los datos recibidos del formulario
		$this->validate($request,[
			'cliente' => 'required',
			'contrario' => 'required'
		]);
		
		//Buscar en las tablas los casos y los casosclientes
		$casocliente = CasosClientes::findOrFail(\Crypt::decrypt($caso_id));
		$caso = Casos::findOrFail($casocliente->casos_id);
		
		//Asignación de valores y actualización de la tabla
		$casocliente->clientes_id = \Crypt::decrypt($request->get('cliente'));
		$casocliente->contrarios_id = \Crypt::decrypt($request->get('contrario'));
		$casocliente->fechaVencimiento = $request->input('fecha-vencimiento');
		$casocliente->naturaleza = $request->input('naturaleza');
		$casocliente->numeroFase = $request->input('numero-fase');
		$casocliente->comentarios = $request['comentarios'];
		
		$casocliente->update();
		
		//Devolución de la vista con los datos actualizados
		return redirect()->route('caso',['caso_id' => \Crypt::encrypt($caso->id),"page=".$request->input('num_pag')]);
	}

	public function newFaseGeneral($num,$caso_id,$cliente_id){
		$casoCliente = new CasosClientes();
		$casoCliente->numeroFase = $num;
		$casoCliente->casos_id = $caso_id;
		$casoCliente->clientes_id = $cliente_id;

		$casoCliente->save();

		return redirect()->route('caso',['caso_id' => \Crypt::encrypt($caso_id),'page='.$num]);
	}
}
