<?php

namespace App\Service;

use App\Models\Profesor;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class NominasNotasService{

    public function nominaNotaCursoService($curso){

        $ratios[$curso->nombre_curso] = DB::table('registro_notas')
            ->select('registro_notas.nota', 'alumnos.nombre_alumno', 'cursos.nombre_curso')
            ->join('carga_academicas','registro_notas.id_carga_academica', '=' , 'carga_academicas.id')
            ->join('alumnos','carga_academicas.id_alumno', '=' , 'alumnos.id')
            ->join('curso_nivels','carga_academicas.id_curso_nivel', '=' , 'curso_nivels.id')
            ->join('cursos','curso_nivels.id_curso', '=' , 'cursos.id')
            ->where('cursos.id', $curso->id)
            ->get();
            // "SELECT registro_notas.nota, alumnos.nombre_alumno, cursos.nombre_curso FROM registro_notas 
            // INNER JOIN carga_academicas ON registro_notas.id_carga_academica = carga_academicas.id 
            // INNER JOIN alumnos ON carga_academicas.id_alumno = alumnos.id
            // INNER JOIN curso_nivels ON carga_academicas.id_curso_nivel = curso_nivels.id 
            // JOIN cursos ON curso_nivels.id_curso = cursos.id WHERE cursos.id = ? ORDER BY registro_notas.nota;", [$curso->id]); 
        $resultado = $ratios;
        return $resultado;
        // return response(MessageResponse::returnResponse($resultado));
    }
}