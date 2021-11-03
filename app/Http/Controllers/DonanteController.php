<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Models\Donantes;
//enviar solicitud 
class DonanteController extends Controller
{
    public function requestDonantesInfo(Request $request, $id)
    {
        $credentials = $request->validate([
            'details' => 'required',
        ]);

        if (auth()->check() && auth()->user()->id == $id) {
            $users = DB::table('requestDonantes')->insert([
                ['user_id' => $id, 'details' => $credentials['details'], 'status' => 0]
            ]);

            return response()->json(["msg" => "Solicitud enviada."], 200);
        } else {
            return response()->json(["msg" => "No autorizado."], 401);
        }
    }
    
    public function confirmEmail(Request $request, $id)
    {
        $resource = User::findOrFail($id);
        $resource->fill(['email_verified_at' => now()]);
        $resource->save();
        return response()->json(["msg" => "Email verificado."], 200);
    }
}
