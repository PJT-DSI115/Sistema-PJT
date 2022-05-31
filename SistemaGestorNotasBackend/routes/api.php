<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\RegistroDocenteCursoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoNivelController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\LineaActividadController;
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

//Routes Login.

Route::post('/login', [LoginController::class, 'login']);

//Routes Niveles.

Route::get('/nivels/index', [NivelController::class, 'index'])
    ->middleware('authJwt:Administrador');
Route::get('/nivels/{codigoNivel}', [NivelController::class, 'show']);
Route::post('/nivels/store', [NivelController::class, 'store']);

//Routes Periodos.

Route::post('/periodos/store', [PeriodoController::class, 'storePeriod'])
    ->middleware('authJwt:Administrador');
Route::get('/periodos/index', [PeriodoController::class, 'indexPeriod'])
    ->middleware('authJwt:Administrador');

Route::post('/periodos/update/{periodo}', [PeriodoController::class, 'updatePeriod'])
    ->middleware('authJwt:Administrador');

Route::post('/periodos/changeState/{periodo}', [PeriodoController::class, 'changeStatePeriod'])
    ->middleware('authJwt:Administrador');

//Routes Curso.

Route::get('/cursos/index', [CursoController::class, 'index']);
Route::post('/cursos/store', [CursoController::class, 'store']);
Route::put('/cursos/update/{curso}', [CursoController::class, 'update']);
Route::delete('/cursos/delete/{id}', [CursoController::class, 'destroy']);

//Routes Actividad.

Route::get('/actividad', [ActividadController::class, 'index']);
Route::get('/actividad/{id}', [ActividadController::class, 'show']);
Route::post('/actividad', [ActividadController::class, 'store']);
Route::post('/actividad/update/{actividad}', [ActividadController::class, 'update']);

//Routes LineaActividad.

Route::get('/linea-actividad', [LineaActividadController::class, 'index']);
Route::get('/linea-actividad/{id}', [LineaActividadController::class, 'show']);
Route::post('/linea-actividad', [LineaActividadController::class, 'store']);
Route::put('/linea-actividad/update/{linea_actividad}', [LineaActividadController::class, 'update']);
Route::delete('/linea-actividad/{id}', [LineaActividadController::class, 'destroy']);

//Routes CursosNivel.

Route::get('/cursos/{id}', [CursoNivelController::class, 'getCursosByNivel']);

//Routes DocenteCurso.

Route::post('/registroDocenteCurso/storeRegister', 
    [RegistroDocenteCursoController::class, 'storeRegisterProfessor']);

Route::get('/registroDocenteCurso/showRegister', 
    [RegistroDocenteCursoController::class, 'getRegisterByIdPeriodAndByIdNivelCurso']);