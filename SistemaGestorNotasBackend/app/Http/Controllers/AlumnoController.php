<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CursoNivel;
use App\Models\Periodo;
use App\Service\AlumnoService;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{

    protected $alumnoService;

    public function __construct(AlumnoService $alumnoService)
    {
        $this->alumnoService = $alumnoService;
    }

    public function index()
    {
        return $this->alumnoService->traerAlumnos();
    }

    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function update(Request $request, Alumno $alumno)
    {
        return $this->alumnoService->modificarAlumno($request, $alumno);
    }

    
    public function destroy(Alumno $alumno)
    {
        return $this->alumnoService->eliminarAlumno($alumno);
    }

    //public function boletaNotas(Periodo $periodo, CursoNivel $cursoNivel)
}
