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
            'documento' => ['required', 'string', 'max:255'],
        ]);

        // $remember = $credentials["remember_token"];

        // unset($credentials["remember_token"]);

        
            //Verificar que los datos de dni existe y que la contraseña es correcta
            if (Auth::attempt($credentials)) {
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
            'lastName'=>['required'],
            // con el script de Nifnie.php le damos restricciones al dni.
            'tipoDocumento'=> ['required'],
            'documento' => ['required'],
            'selectorPais'=>['required'],
            'provincia'=> ['required'],
            'poblacion'=> ['required'],
            'cp'=>['required'],
            'cuota'=> ['required'],
            'tipoCuota'=> ['required'],
            'phoneNumber'=>['required'],
            'nameBank'=>['required'],
            'iban'=> ['required'],
            'email' => ['required', 'email'],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        // Encrypt password
        $request['password'] = bcrypt($request['password']);

 
        if ($request['cuotaManual'] == null) {
            $request['cuotaManual'] = "NO";
        };

        //crear usuario
        $usuarioCreado = User::create($request->all());
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

