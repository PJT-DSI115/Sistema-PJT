<?php

namespace App\Service;

use App\Models\Curso;
use App\Models\CursoNivel;
use App\Models\Periodo;
use App\Models\Nivel;
use App\Models\Profesor;
use App\Models\RegistroDocenteCurso;
use Carbon\Carbon;
use App\Utils\ValidateJsonRequest;
class RegistroDocenteCursosService {


    public function registroDocente($data) {

        $responseValidate = ValidateJsonRequest::validateJsonRequestRegistroDocenteCurso($data);
        if(count($responseValidate) > 0) {
            return $responseValidate;
        }

        $idPeriodo = $data['idPeriodo'];
        $idNivel = $data['idNivel'];
        $rol = $data['rol'];
        $idDocente = $data['idDocente'];
        $idCurso = $data['idCurso'];


        $periodo = Periodo::find($idPeriodo);
        $nivel = Nivel::find($idNivel);
        $docente = Profesor::find($idDocente);
        $curso = Curso::find($idCurso);

        $nivelCurso = CursoNivel::where('id_curso', '=', $idCurso)
            ->where('id_nivel', '=', $idNivel)->first();
        error_log($nivelCurso);


        $registroDocenteCurso = new RegistroDocenteCurso;
        $registroDocenteCurso->id_docente = $idDocente;
        $registroDocenteCurso->id_nivel_curso = $nivelCurso->id;
        $registroDocenteCurso->id_periodo = $idPeriodo;
        $registroDocenteCurso->rol = $rol;
        $registroDocenteCurso->created_at = Carbon::now();

        $registroDocenteCurso->save();


        return [
            "periodo" => $periodo,
            "nivel" => $nivel,
            "docente" => $docente,
            "curso" => $curso
        ];

    }

}

