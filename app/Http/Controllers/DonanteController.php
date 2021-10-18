<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Donante;

class DonanteController extends Controller
{
     //Validar datos 
     public function store(Request $request)
     {
         $datos_validados = $request->validate([
             'nombre' => 'required|min:3',
             'email' => 'required',
         ]);
         //crear
         Donante::create($datos_validados);
         return ['mensaje' => 'Usuario creado'];
     }
     //mostrar un solo donante por id
    public function show($id)
    {
        //buscar donante por id 
        $estudiante = Donante::find($id);
        //comprobar si el donante existe
        if(!$estudiante){
            return ['error' => 'Donante no encontrado'];
        }
        return ['datos' => $estudiante];
    }
}
