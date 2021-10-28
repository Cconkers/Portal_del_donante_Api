<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DonanteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeticionesController;
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
Route::post('/register',[Authcontroller::class,'register'])->middleware('api');
//manda un mensaje a tu correo para restablecer la contraseña
Route::post('/reset-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
//vista del mensaje

//recupera la contraseña
Route::post('/reset-password-token', [ForgotPasswordController::class, 'submitResetPasswordForm']);


Route::get('/upload-file', [FileUploadController::class, 'createForm']);

Route::post('/upload-file', [FileUploadController::class, 'fileUpload'])->name('fileUpload');


//middleware esto dice que si no estas logeado no podras acceder a las siguientes rutas.
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/perfil', [DonanteController::class, 'show']);
    Route::post('/donantes/request/{id}', [DonanteController::class, 'requestDonanteInfo']);
    // Salir de usuario logeado.
    Route::get('/logout' , [Authcontroller::class, 'logout']);
});
Route::group(['middleware' => ['auth:sanctum','admin']], function () {
    Route::get('/donantes', [AdminController::class, 'index']);
    Route::post('/donantes/byDocument', [AdminController::class, 'getDonante']);
    Route::get('/donantes/request', [AdminController::class, 'getPendingRequest']); 
    
});