<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Donante;
use Illuminate\Support\Facades\Auth;

class DonanteController extends Controller
{
    //mostrar un solo donante por id
    public function show()
    {
        //buscar donante por id 
        $donante = Donante::where('NIFtitular', Auth::user()->NIFtitular)->get();
        //comprobar si el donante existe
        if(!$donante){
            return ['error' => 'Donante no encontrado'];
        }
        return ['datos' => $donante];
    }
}
