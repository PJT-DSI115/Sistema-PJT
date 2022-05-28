<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\PeriodoController;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);

Route::get('/nivels', [NivelController::class, 'index']);
Route::get('/nivels/{codigoNivel}', [NivelController::class, 'show']);
Route::post('/nivels/store', [NivelController::class, 'store']);


Route::post('/periodos/store', [PeriodoController::class, 'store'])
->middleware('authJwt:Administrador');
Route::get('/periodos/index', [PeriodoController::class, 'index'])
->middleware('authJwt:Administrador');