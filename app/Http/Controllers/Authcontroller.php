<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\NifNie;
use App\Models\Donante;

use Exception;

class AuthController extends Controller
{
    //validas los datos.
    public function login(Request $request)
    {
        //Validar los datos
        $credentials = $request->validate([

            'password' => ['required'],
            'NIFtitular' => [new NifNie, 'required', 'string', 'max:255'],
           
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
        } else {

            return response(['Error' => 'Vuelve introducir tus datos'], 401);
        }
    }



    //Registrar usuario
    public function register(Request $request)
    {
        //verificar
        $credentials = $request->validate([
            'NombreColaborador' => 'required',
            'ApellidosColaborador' => 'required',
            // con el script de Nifnie.php le damos restinciones al dni.
            'NIFtitular' => [new NifNie, 'required', 'string', 'max:255', 'unique:users,NIFtitular'],
            'EMail' => ['required',],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'localidad' => 'required',
            'Codigo_Postal' => 'required',
            'Cuota'  => 'required',
            'Movil' => 'required',
            'telefono2' => 'required',
            
            
        ]);

        // Encrypt password
        $credentials['password'] = bcrypt($credentials['password']);

        //crear usuario para tabla usuario
        $usuarioCreado = User::create($credentials);
        //crear usuario para la tabla Donante
        
        unset($credentials['password']);
        unset($credentials['confirm_password']);
        $DonanteCreado = Donante::create($credentials);
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
