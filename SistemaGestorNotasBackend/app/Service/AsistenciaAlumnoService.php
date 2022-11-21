<?php

namespace App\Service;

use App\Models\Profesor;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class AsistenciaAlumnoService{

    public function asistenciaAlumnoService($alumno,$periodo, $curso){


        //ASISTENCIA POR ALUMNO, PERIODO Y CURSO
        $asistencia = DB::table('asistencias')
            ->select('alumnos.nombre_alumno', 'periodos.codigo_periodo', 'asistencias.fechaAsistencias','asistencias.asistencia', 'cursos.nombre_curso')
            ->join('carga_academicas','asistencias.id_carga_academicas', '=' , 'carga_academicas.id')
            ->join('alumnos','carga_academicas.id_alumno', '=' , 'alumnos.id')
            ->join('periodos','carga_academicas.id_periodo', '=' , 'periodos.id')
            ->join('curso_nivel_mes','asistencias.id_curso_nivel_mes', '=' , 'curso_nivel_mes.id')
            ->join('curso_nivels','curso_nivel_mes.id_curso_nivel', '=' , 'curso_nivels.id')
            ->join('cursos','curso_nivels.id_curso', '=' , 'cursos.id')
            ->where('carga_academicas.id_alumno', $alumno)
            ->where('periodos.id', $periodo)
            ->where('cursos.id', $curso)
            ->get();

        $resultado = $asistencia;
   
        return $resultado;

    }


    public function asistenciaAlumnoServicePDF($alumno,$periodo, $curso){


        //ASISTENCIA POR ALUMNO, PERIODO Y CURSO
        $asistencia = DB::table('asistencias')
            ->select('alumnos.nombre_alumno', 'periodos.codigo_periodo', 'asistencias.fechaAsistencias','asistencias.asistencia', 'cursos.nombre_curso')
            ->join('carga_academicas','asistencias.id_carga_academicas', '=' , 'carga_academicas.id')
            ->join('alumnos','carga_academicas.id_alumno', '=' , 'alumnos.id')
            ->join('periodos','carga_academicas.id_periodo', '=' , 'periodos.id')
            ->join('curso_nivel_mes','asistencias.id_curso_nivel_mes', '=' , 'curso_nivel_mes.id')
            ->join('curso_nivels','curso_nivel_mes.id_curso_nivel', '=' , 'curso_nivels.id')
            ->join('cursos','curso_nivels.id_curso', '=' , 'cursos.id')
            ->where('carga_academicas.id_alumno', $alumno)
            ->where('periodos.id', $periodo)
            ->where('cursos.id', $curso)
            ->get();

        $resultado = $asistencia;
   
        return $resultado;

    }
}