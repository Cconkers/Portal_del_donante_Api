<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\NifNie;


class AdminController extends Controller
{
    public function index()
    {
        //trae todos los usuarios menos el de este documento.
        $donantes = User::where('documento', '!=',  Auth::user()->documento)->get();
        return $donantes;
    }
    public function getdonante(Request $request)
    {
            //Validar los datos
            $credentials = $request->validate([
        'documento' => [new NifNie,'required', 'string', 'max:255'],
            ]);
        //trae todos los usuarios menos el de este documento.
        $donante = User::where('documento', '=', $credentials['documento'])->firstOrFail();
        return $donante;
       
    }
}
