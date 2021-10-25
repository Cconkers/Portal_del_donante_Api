<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function index()
    {
        //trae todos los usuarios menos el de este documento.
        $donantes = User::where('documento', '!=',  Auth::user()->documento)->get();
        return $donantes;
    }
     //mostrar un solo donantes por id
     public function show($id)
     {
         //buscar estudiante por id 
         $estudiante = Estudiante::find($id);
         //comprobar si el estudiante existe
         if(!$estudiante){
             return ['error' => 'Estudiante no encontrado'];
         }
         return ['datos' => $estudiante];
     }
}
