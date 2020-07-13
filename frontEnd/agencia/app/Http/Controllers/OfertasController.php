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
                $nameFile = $file->getClientOriginalName();
                $filename = $file->move('files', $name);
                // dd($file->size());
                // $uploadId = new ofertas;
                // $uploadId->path_img = $nameFile;
                // $uploadId->save();
                $uploadId[] = upload::create([
                    'name'  =>  $name,
                    'path'  =>  $nameFile
                    ])->id;
            }
        }
        return response()->json($uploadId, 200);
    }
}
