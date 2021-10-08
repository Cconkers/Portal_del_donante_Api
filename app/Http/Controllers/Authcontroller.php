<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\NifNie;

use Exception;

class AuthController extends Controller
{
    //validas los datos.
    public function login(Request $request)
    {
        //Validar los datos
        $credentials = $request->validate([

            'password' => ['required'],
            'dni' => [new NifNie, 'required', 'string', 'max:255'],
            'remember_token' => ['required'],
        ]);

        $remember = $credentials["remember_token"];

        unset($credentials["remember_token"]);

        
            //Verificar que el los datos de dni existe y que la contraseña es correcta
            if (Auth::attempt($credentials, $remember)) {
                $usuarioLogeado = Auth::user();
                $token = $usuarioLogeado->createToken('TokenUsuario')->plainTextToken;
                return [
                    'mensaje' => 'se ha logeado correctamente',
                    'usuario' => $usuarioLogeado,
                    'token' => $token
                ];
            } 
         else {
             
            return ['error' => 'Error introduce de nuevos tus datos.'];
        } 
        
        } 
            
    

    //Registrar usuario
    public function register(Request $request)
    {
        //verificar
        $credentials = $request->validate([
            'name' => 'required',
            // con el script de Nifnie.php le damos restinciones al dni.
            'dni' => [new NifNie, 'required', 'string', 'max:255', 'unique:users,dni'],
            'email' => ['required', 'email'],
            'password' => 'required',
            'confirm_password' => 'required|same:password',

        ]);

        // Encrypt password
        $credentials['password'] = bcrypt($credentials['password']);

        //crear usuario
        $usuarioCreado = User::create($credentials);
        //generar el token
        $token = $usuarioCreado->createToken('TokenUsuario')->plainTextToken;
        //devolver respuesta
        return [
            'mensaje' => 'usuario registrado',

            'usuario' => $usuarioCreado,

            'token' => $token

        ];
    }
    //para cerrar de la sesión
    public function logout()
    {
        $usuarioLogeado = Auth::user();
        $usuarioLogeado->tokens()->delete();
        return ['mensaje' => 'usuario desconectado.'];
    }

 
   
    

}

