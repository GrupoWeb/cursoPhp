<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ofertas;
use App\Model\upload;

class OfertasController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function createOfertas(){
        return view('frontEnd.oferta'); 
    }

    public function store(Request $request)
    {
        
        $uploadId = array();
        if ( $files =  $request->file('file')) {
            foreach ($request->file('file') as $key => $file) {
                $name = time() . $key . $file->getClientOriginalName();
                $nameFile = 'files/' . $file->getClientOriginalName();
                $filename = $file->move('files', $name);
                $uploadId[] = upload::create([
                    'name'  =>  $name,
                    'path'  =>  $nameFile
                    ])->id;
            }
        }
        return response()->json($uploadId, 200);
    }

    public function uploadFile(Request $request){
        $upload[] = ofertas::create([
           'nombre_oferta'      =>      $request->nombre,
           'precio_oferta'      =>      $request->precio,
           'descripcion'        =>      $request->descripcion,
           'id_img'             =>      $request->id 
        ]);

        return response()->json($upload,200);
    }
}
