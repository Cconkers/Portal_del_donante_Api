<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

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
Route::post('/forgot',[Authcontroller::class,'forgot']);


//middleware esto dice que si no estas logeado no podras acceder a las siguientes rutas.
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/estudiantes', [EstudiantesController::class, 'index']);
    Route::get('/estudiantes/{id}', [EstudiantesController::class, 'show']);
    Route::post('/estudiantes', [EstudiantesController::class, 'store']);
    Route::put('/estudiantes/{id}', [EstudiantesController::class, 'update']);
    Route::delete('/estudiantes/{id}', [EstudiantesController::class, 'destroy']);
    // Salir de usuario logeado.
    Route::get('/logout' , [Authcontroller::class, 'logout']);
});