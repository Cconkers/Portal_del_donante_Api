<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Mail\EmailConfirmation;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use App\Models\User;
use App\Models\Donantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\NifNie;
use Illuminate\Support\Facades\Mail;
use Exception;

class AuthController extends Controller
{
    //validas los datos.
    public function login(Request $request)
    {
        //Validar los datos
        $credentials = $request->validate([

            'password' => ['required'],


            'documento' => [new NifNie, 'required', 'string', 'max:255'],
        ]);

        // $remember = $credentials["remember_token"];

        // unset($credentials["remember_token"]);


        //Verificar que los datos de dni existe y que la contraseña es correcta
        if (Auth::attempt($credentials)) {
            $usuarioLogeado = Auth::user(['verify' => true]);
            $token = $usuarioLogeado->createToken('TokenUsuario')->plainTextToken;
            return [
                'mensaje' => 'se ha logeado correctamente',
                'usuario' => $usuarioLogeado,
                'token' => $token
            ];
        } else {
            return response()->json(["Error" => "Datos de login incorrectos"], 401);
        }
    }
    public function refreshUser()
    {

        return response()->json([

            'usuario' => Auth::user(['verify' => true])
        ]);
    }


    //Registrar usuario
    public function register(Request $request)
    {
        //verificar
        $credentials = $request->validate([

            'name' => ['required'],
            'lastName' => ['required'],
            'tipoDocumento' => ['required'],
            'documento' => ['required', 'unique:users,documento'],
            'selectorPais' => ['required'],
            'direccion' => ['required'],
            'provincia' => ['required'],
            'poblacion' => ['required'],
            'cp' => ['required'],
            'cuota' => ['required'],
            'tipoCuota' => ['required'],
            'phoneNumber' => ['required'],
            'phoneNumber2' => ['required'],
            'nameBank' => ['required'],
            'iban' => ['required'],
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
        $usuarioCreado = User::create(
            $request->only('documento', 'tipoDocumento', 'email', 'password', 'estado')
        );
        Donantes::create(
            array_merge($request->except('nameBank', 'iban', 'documento', 'tipoDocumento', 'email', 'password', 'estado'), ['user_id' => $usuarioCreado->id])
        );


        //generar el token
        $token = $usuarioCreado->createToken('TokenUsuario')->plainTextToken;
        $credentials['id'] = $usuarioCreado->id;
        Mail::send(new RegisterMail($credentials));
        Mail::send(new EmailConfirmation($credentials));
        //devolver respuesta
        return [
            'mensaje' => 'usuario registrado',

            'usuario' => $usuarioCreado->fresh(),

            'token' => $token

        ];
    }
    //para cerrar de la sesión
    public function logout()
    {
        $usuarioLogeado = Auth::user(['verify' => true]);
        $usuarioLogeado->tokens()->delete();
        return ['mensaje' => 'usuario desconectado.'];
    }
}
