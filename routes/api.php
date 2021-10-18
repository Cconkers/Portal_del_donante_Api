<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DonanteController;
use App\Mail\ResetPasswordNotification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//ruta login
Route::post('/login',[Authcontroller::class,'login']);
Route::post('/register',[Authcontroller::class,'register']);
//manda un mensaje a tu correo para restablecer la contraseña
Route::post('/reset-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
//vista del mensaje
Route::get('/donantes/{id}', [DonanteController::class, 'show']);
   
//recupera la contraseña
Route::post('/reset-password-token', [ForgotPasswordController::class, 'submitResetPasswordForm']);

//middleware esto dice que si no estas logeado no podras acceder a las siguientes rutas.
    Route::middleware('auth:sanctum')->group(function(){
    
    
    
    // Salir de usuario logeado.
    Route::get('/logout' , [Authcontroller::class, 'logout']);
});