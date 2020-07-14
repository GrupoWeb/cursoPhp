<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ofertas;
use App\Model\upload;
use App\Model\paquetePersona;
use Illuminate\Support\Facades\DB;

class OfertasController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function createOfertas(){
        return view('frontEnd.oferta'); 
    }

    public function MostrarAgenda(){
        return view('frontEnd.agendar');
    }

    public function store(Request $request) 
    {
        DB::beginTransaction();
        try {
            $uploadId = array();
            if ( $files =  $request->file('file')) {
                foreach ($request->file('file') as $key => $file) {
                    $name = time() . $key . $file->getClientOriginalName();
                    $nameFile = 'files/' . $name;
                    $filename = $file->move('files', $name);
                    $uploadId[] = upload::create([
                        'name'  =>  $name,
                        'path'  =>  $nameFile
                        ])->id;
                }
            }
            DB::commit();
            return response()->json($uploadId, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th, 404);
        }
    }
    
    public function uploadFile(Request $request){
        DB::beginTransaction();
        try {
            $upload[] = ofertas::create([
                'nombre_oferta'      =>      $request->nombre,
                'precio_oferta'      =>      $request->precio,
                'descripcion'        =>      $request->descripcion,
                'id_img'             =>      $request->id 
                ]);
                
                DB::commit();
                return response()->json($upload,200);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json($th, 404); 
        }
    }


    public function getOfertas(){
        $data = ofertas::select('nombre_oferta','precio_oferta','descripcion','uploads.name as imgPath')->join('uploads','uploads.id','=','id_img')->get();
        return response()->json($data,200); 
    }

    public function getPaquetes(){
        $data = ofertas::select('id','nombre_oferta')->get();
        return response()->json($data,200);
    }

    public function addPaquetes(Request $request){

        DB::beginTransaction();

        try {
            $agenda[] = paquetePersona::create([
                'nombre_persona'        => $request->nombre,
                'nit'                   => $request->nit,
                'direccion'             => $request->direccion,
                'telefono'              => $request->telefono,
                'estado'                => 'A',
                'id_paquete'            => $request->paquete
            ]);

            DB::commit();
            return response()->json($agenda,200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th,404);
        }
    }

    public function consulta(){
        return view('frontEnd.consulta');
    }

    public function getConsulta(){
        $data = paquetePersona::select('nombre_persona','nit','direccion','telefono','estado', 'ofertas.nombre_oferta')
            ->join('ofertas','ofertas.id','=','paquete_personas.id_paquete')->get();

        return response()->json($data,200);
    }
}
