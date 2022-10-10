<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\DB;

class ConsultaNotasService {

    public function consultarNotasCursoNivelMesService($periodo, $curso_nivel, $mes){
        $registros = DB::table("registro_notas")
        ->distinct()
        ->select("alumnos.codigo_alumno", "alumnos.nombre_alumno", "alumnos.apellido_alumno",
        "linea_actividads.codigo_linea_actividad", "registro_notas.nota", "mes.codigo_mes")
        ->join("carga_academicas", "alumnos.id", "=", "carga_academicas.id_alumno")
        ->join("registro_notas", "carga_academicas.id", "=" , "registro_notas.id_carga_academica")
        ->join("linea_actividads", "linea_actividads.id", "=" , "registro_notas.id_linea_actividad")
        ->join("curso_nivels", "carga_academicas.id_curso_nivel", "=" , "curso_nivels.id")
        ->join("curso_nivel_mes", "curso_nivel_mes.id_curso_nivel", "=" , "curso_nivels.id")
        ->join("mes", "curso_nivel_mes.id_mes", "=", "mes.id")
        ->where("carga_academicas.id_periodo", $periodo->id)
        ->where("carga_academicas.id_curso_nivel", $curso_nivel->id)
        ->where("mes.id", $mes->id)
        ->get();

        return $registros;
    }

}