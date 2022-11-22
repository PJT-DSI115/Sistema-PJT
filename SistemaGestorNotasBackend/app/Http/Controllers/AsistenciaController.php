<?php

namespace App\Http\Controllers;

use App\Service\Asis;
use App\Service\AsistenciaAlumnoService;
use App\Service\NominasNotasService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    //

    protected $asistencia;

    public function __construct(AsistenciaAlumnoService $asistencia)
    {
        $this->asistencia = $asistencia;
    }

    public function asistenciaAlumno($alumno, $periodo, $curso)
    {
        return $this->asistencia->asistenciaAlumnoService($alumno, $periodo, $curso);
    }

    public function asistenciaAlumnoPDF($alumno, $periodo, $curso)
    {
        return $this->asistencia->asistenciaAlumnoServicePDF($alumno, $periodo, $curso);

    }

}
?>
