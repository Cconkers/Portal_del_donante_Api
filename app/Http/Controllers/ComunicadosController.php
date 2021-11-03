<?php

namespace App\Http\Controllers;
use App\Models\Comunicado;
use Illuminate\Http\Request;

class ComunicadosController extends Controller
{
    public function index(){
        return response()->json(Comunicado::all());
    }
    public function show($id){      
        return response()->json([
            'data' => Comunicado::find($id)
        ], 200);
    }
}
