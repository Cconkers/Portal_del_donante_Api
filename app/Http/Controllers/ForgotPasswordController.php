<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
   
    //función para mandar un mensaje al correo para restablecer password
    public function submitForgetPasswordForm(Request $request)
      
    {
        $request->validate(['email' => 'required|email']);
       
        Password::sendResetLink(
           $request->only('email')
        );


        return response()->json(["msg" => 'se ha enviado un mensaje a tu correo para restablecer la contraseña.']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // Resetea la contraseña.
    public function submitResetPasswordForm() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            
            $user->save();
        });
        
        
        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Token obtenido inválido"], 400);
        }

        return response()->json(["msg" => "La contraseña se ha cambiado correctamente"]);
    }
}
