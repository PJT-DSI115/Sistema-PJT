<?php

namespace App\Service;

use App\Models\Profesor;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class AsistenciaAlumnoService{

    public function asistenciaAlumnoService($alumno,$periodo){

        $asistencia = DB::table('asistencias')
            ->select('alumnos.nombre_alumno', 'periodos.codigo_periodo', 'asistencias.fechaAsistencias','asistencias.asistencia')
            ->join('alumnos','asistencias.id_alumno', '=' , 'alumnos.id')
            ->join('periodos','asistencias.id_periodo', '=' , 'periodos.id')
            ->where('asistencias.id_alumno', $alumno)
            ->where('asistencias.id_periodo', $periodo)
            ->get();
        $resultado = $asistencia;
        
        
        return $resultado;

    }
}