<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\RegistroDocenteCursoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoNivelController;
use App\Http\Controllers\CursoNivelMesController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CargaAcademicaController;
use App\Http\Controllers\LineaActividadController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\RegistroNotasController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
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
    ->middleware('authJwt:Administrador,Coordinador');
Route::get('/nivels/{codigoNivel}', [NivelController::class, 'show'])
    ->middleware('authJwt:Administrador');
Route::post('/nivels/store', [NivelController::class, 'store'])
    ->middleware('authJwt:Administrador');
Route::put('/nivels/update/{nivel}', [NivelController::class, 'update'])
    ->middleware('authJwt:Administrador');
Route::delete('/nivels/delete/{id}', [NivelController::class, 'destroy'])
    ->middleware('authJwt:Administrador');

//Routes Periodos.
Route::post('/periodos/store', [PeriodoController::class, 'storePeriod'])
    ->middleware('authJwt:Administrador');
Route::get('/periodos/index', [PeriodoController::class, 'indexPeriod'])
    ->middleware('authJwt:Administrador,Docente');
Route::post('/periodos/update/{periodo}', [PeriodoController::class, 'updatePeriod'])
    ->middleware('authJwt:Administrador');
Route::post('/periodos/changeState/{periodo}', [PeriodoController::class, 'changeStatePeriod'])
    ->middleware('authJwt:Administrador');

Route::get('/periodos/getPeriodosByUser', [PeriodoController::class, 'getAllPeriodosByUser'])
    ->middleware('authJwt:Docente,Alumno,Administrador,Coordinador');

//Routes Curso.
Route::get('/curso/index', [CursoController::class, 'index'])
    ->middleware('authJwt:Administrador');
Route::post('/curso/store', [CursoController::class, 'store'])
    ->middleware('authJwt:Administrador');
Route::put('/curso/update/{curso}', [CursoController::class, 'update'])
    ->middleware('authJwt:Administrador');
Route::delete('/curso/delete/{id}', [CursoController::class, 'destroy'])
    ->middleware('authJwt:Administrador');

//Routes Actividad.
Route::get('/actividad/{id_periodo}/{id_curso_nivel}', [ActividadController::class, 'indexActividad'])
    ->middleware('authJwt:Docente,Administrador');
Route::post('/actividad', [ActividadController::class, 'storeActividad'])
    ->middleware('authJwt:Docente,Administrador');
Route::put('/actividad/{actividad}', [ActividadController::class, 'updateActividad'])
    ->middleware('authJwt:Docente,Administrador');
Route::delete('/actividad/{actividad}', [ActividadController::class, 'destroyActividad'])
    ->middleware('authJwt:Docente,Administrador');

//Routes LineaActividad.
Route::get('/linea-actividad', [LineaActividadController::class, 'index']);
Route::get('/linea-actividad/{id}', [LineaActividadController::class, 'show']);
Route::post('/linea-actividad', [LineaActividadController::class, 'store']);
Route::put('/linea-actividad/update/{linea_actividad}', [LineaActividadController::class, 'update']);
Route::delete('/linea-actividad/{id}', [LineaActividadController::class, 'destroy']);

//Routes CursosNivel.
Route::get('/cursos/{id}', [CursoNivelController::class, 'getCursosByNivel'])
    ->middleware('authJwt:Administrador,Coordinador');

//Routes DocenteCurso.
Route::post('/registroDocenteCurso/storeRegister', 
    [RegistroDocenteCursoController::class, 'storeRegisterProfessor']);

Route::get('/registroDocenteCurso/showRegister', 
    [RegistroDocenteCursoController::class, 'getRegisterByIdPeriodAndByIdNivelCurso']);

Route::delete('/registroDocenteCurso/delete/{registroDocenteCurso}', 
    [RegistroDocenteCursoController::class, 'deleteRegisterDocenteCurso']);

Route::put('/registroDocenteCurso/update/{registroDocenteCurso}', 
    [RegistroDocenteCursoController::class, 'updateRegisterDocenteCurso']);

Route::get('/docente/getAll', [DocenteController::class, 'getAllDocentes']);


Route::get('/getAllCursosNivelByDocente', [RegistroDocenteCursoController::class, 'getAllRegisterByDocentePeriodoCursoNivel'])
    ->middleware('authJwt:Docente');


Route::get('/periodo/searchPeriodoActivo', [PeriodoController::class, 'searchPeriodoActivo']);

//Routes Carga Académica
Route::get('/cargaAcademica/lineasActividad/{cargaAcademica}', [CargaAcademicaController::class, 'indexLineaActividadByCursoNivel']);

Route::get('/cargaAcademica/{id_periodo}/{id_curso_nivel}', [CargaAcademicaController::class, 'indexAlumnosByCarga'])
    ->middleware('authJwt:Docente');

Route::get('/cursoNivelMes/mes/{cargaAcademica}', [CursoNivelMesController::class, 'indexMesesByCursoNivel']);
//Route Notas
Route::post('/registrarNota', [RegistroNotasController::class, 'storeNota']);
Route::post('/registroAlumno', [AlumnoController::class, 'registerAlumnosByExcel']);

//Routes for Managment Users
Route::get('/getAllUsers/students', [UserController::class, 'getAllUserByStudents'])
    ->middleware('authJwt:Administrador');
Route::get('/getAllUsers/teachers', [UserController::class, 'getAllUserByTeachers'])
    ->middleware('authJwt:Administrador');
Route::post('/storeUser', [UserController::class, 'storeUser'])
    ->middleware('authJwt:Administrador');

Route::get('/getUsersByFilter', [UserController::class, 'getUserFilter'])
    ->middleware('authJwt:Administrador');

Route::post('/deleteUser', [UserController::class, 'deleteUser'])
    ->middleware('authJwt:Administrador');

Route::post('/changePasswordUser', [UserController::class, 'changePassword'])
    ->middleware('authJwt:Administrador');


//Routes for Roles

Route::get('/getAllRoles', [RolController::class, 'index'])
    ->middleware('authJwt:Administrador');



