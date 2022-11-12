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

    public function asistenciaAlumno($alumno, $periodo)
    {
        return $this->asistencia->asistenciaAlumnoService($alumno, $periodo);
    }

    public function asistenciaAlumnoPDF($alumno, $periodo)
    {
        $asistencia = DB::table('asistencias')
            ->select('alumnos.nombre_alumno', 'periodos.codigo_periodo', 'asistencias.fechaAsistencias', 'asistencias.asistencia')
            ->join('alumnos', 'asistencias.id_alumno', '=', 'alumnos.id')
            ->join('periodos', 'asistencias.id_periodo', '=', 'periodos.id')
            ->where('asistencias.id_alumno', $alumno)
            ->where('asistencias.id_periodo', $periodo)
            ->get();
        $resultado = $asistencia;

        $pdf = PDF::loadView('pdf3', ['asistencias' => $resultado])->setPaper('a4', 'landscape')->setWarnings(false)->save('nomina.pdf');
        return $pdf->stream();
    }

    public function asistenciPeriodoPDF($periodo)
    {
        $asistencia = DB::table('asistencias')
            ->select('alumnos.nombre_alumno', 'periodos.codigo_periodo', 'asistencias.fechaAsistencias', 'asistencias.asistencia')
            ->join('alumnos', 'asistencias.id_alumno', '=', 'alumnos.id')
            ->join('periodos', 'asistencias.id_periodo', '=', 'periodos.id')
            ->where('asistencias.id_periodo', $periodo)
            ->get();
        $resultado = $asistencia;

        $pdf = PDF::loadView('pdf4', ['asistenciasPeriodo' => $resultado])->setPaper('a4', 'landscape')->setWarnings(false)->save('nomina.pdf');
        return $pdf->stream();
    }
}
