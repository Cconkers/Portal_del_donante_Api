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
        $donantes = User::where('documento', '!=',  Auth::user()->documento)->get()->pluck("donante");
        return $donantes;
    }
}
