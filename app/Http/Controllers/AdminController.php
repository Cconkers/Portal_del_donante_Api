<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class AdminController extends Controller
{
    public function index()
    {
        //trae todos los usuarios menos el de este documento.
        $donantes = User::where('documento', '!=',  Auth::user()->documento)->get();
        return $donantes;
    }
    public function getDonante(Request $request)
    {
        //Validar los datos
        $credentials = $request->validate([
            'documento' => ['required', 'string', 'max:255'],
        ]);
        //trae el usuario que contenga el dni
        $donante = User::where('documento', 'like', '%' . $credentials['documento'] . '%')->get();
        return $donante;
    }
    public function getPendingRequest()
    {
        $user_id = DB::table('requestDonantes')->where('status', true)->get(['user_id']);
        $arraysID = json_decode(json_encode($user_id), true);

        $users = DB::table('requestDonantes')
            ->join('users', 'requestDonantes.user_id', '=', 'users.id')
            ->join('donantes', 'requestDonantes.user_id', '=', 'donantes.user_id')
            ->select('requestDonantes.*', 'donantes.name', 'users.documento')
            ->whereIn('users.id', $arraysID)
            ->get();

        return $users;    
       
    }
}
