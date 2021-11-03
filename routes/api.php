<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ComunicadosController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DonanteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeticionesController;
use App\Mail\ResetPasswordNotification;
use GuzzleHttp\Middleware;

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
Route::post('/login', [Authcontroller::class, 'login']);
Route::post('/register', [Authcontroller::class, 'register'], [RegisterController::class,])->middleware('api');
//manda un mensaje a tu correo para restablecer la contraseña
Route::post('/reset-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);

//Confirmación del correo electrónico
Route::get('/confirm-email/{id}', [DonanteController::class, 'confirmEmail']);


//recupera la contraseña
Route::post('/reset-password-token', [ForgotPasswordController::class, 'submitResetPasswordForm']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



//middleware esto dice que si no estas logeado no podras acceder a las siguientes rutas.
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::post('/upload-file', [FilesController::class, 'fileUpload'])->name('fileUpload');
        Route::get('/donantes', [AdminController::class, 'index']);
        Route::post('/donantes/byDocument', [AdminController::class, 'getDonante']);
        Route::get('/donantes/request', [AdminController::class, 'getPendingRequest']); 
    });
    Route::get('/comunicados/{id}', [ComunicadosController::class, 'show']);
    Route::get('/perfil', [DonanteController::class, 'show']);
    Route::post('/donantes/request/{id}', [DonanteController::class, 'requestDonantesInfo']);
    Route::get('/refresh', [Authcontroller::class, 'refreshUser']);
    Route::get('/comunicados', [ComunicadosController::class, 'index']);
    // Salir de usuario logeado.
    Route::get('/logout', [Authcontroller::class, 'logout']);
});
