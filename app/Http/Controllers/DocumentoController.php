<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests;

use App\Casos;
use App\Documento;
use App\Personas;

class DocumentoController extends Controller
{
    //Método para guardar un fichero
    public function saveFile(Request $request){
        //Validación de los datos recibidos del formulario. Solo se permiten ficheros con extensión pdf, doc y docx
        $validation = $this->validate($request,[
            'title' => 'required|string',
            'documento' => 'required|mimes:docx,doc,pdf,rtf|mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/rtf'
        ]);
        
        //Búsqueda del caso al que se asignará el fichero
        $casoID = \Crypt::decrypt($request->input('casos_id'));
        $caso = Casos::find($casoID);
        
        //Nuevo objeto de documento
        $documento = new Documento();
        
        //Asignación de valores a la tabla Documentos
        $documento->nombre = $request->input('title');
        $documento->id_casos = $casoID;
        
        //Obtención del fichero
        $documento_file = $request->file('documento');
                
        if($documento_file){
            //Renombrado del fichero recibido
            $rutaDocumento = date('ynjHis').$documento_file->getClientOriginalName();
            //Guardar el fichero en el servidor
            Storage::disk('files')->put($rutaDocumento,File::get($documento_file));
            //Guardar la ruta en la base de datos
            $documento->path = $rutaDocumento;
        }
        
        $documento->save();
        
        //Redirección a la vista actualizada
        return redirect()->route('caso',['caso_id' => \Crypt::encrypt($caso->id)]);
        
    }
    
    public function mostrarDocumento($filename){
        //Obtención del fichero del disco del servidor
        $file = Storage::disk('files')->get($filename);
        $path = storage_path('app/files')."/".$filename;
        
        return response()->file($path);
    }
    
    public function deleteDocument($id){
        //Búsqueda del documento
        $documento = Documento::find(\Crypt::decrypt($id));
        
        //Borrado del documento físicamente del disco
        if(Storage::disk('files')->get($documento->path)){
            Storage::disk('files')->delete($documento->path);
        }
        
        //Borrado del documento de la base de datos
        if($documento){
            $documento->delete();
        }
        
        return redirect()->route('caso',['caso_id' => \Crypt::encrypt($documento->id_casos)]);
        
    }
}
