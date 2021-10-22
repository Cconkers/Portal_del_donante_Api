<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Donante;
use Illuminate\Support\Facades\Auth;

class DonanteController extends Controller
{
    //mostrar un solo donante por dni
    public function show()
    {
        //buscar donante por dni 
        $donante = Donante::where('documento', Auth::user()->documento)->get();
        //comprobar si el donante existe
        if(!$donante){
            return ['error' => 'Donante no encontrado'];
        }
        return ['datos' => $donante];
    }
}
