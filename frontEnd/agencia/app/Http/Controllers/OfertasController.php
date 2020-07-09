<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        dd($request);
        $uploadId = array();
        if ( $files =  $request->file('file')) {
            foreach ($request->file('file') as $key => $file) {
                $name = time() . $key . $file->getClientOriginalName();
                $nameFile = $file->getClientOriginalName();
                $filename = $file->move('files', $name);
                $uploadId[] = Upload::create([
                    'file' => $name,
                    'file_name' =>$nameFile,
                    'evento_id' => $request->evento_id])->id;
            }
        }
        return response()->json($uploadId, 200);
    }
}
