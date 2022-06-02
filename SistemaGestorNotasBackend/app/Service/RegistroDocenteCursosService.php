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
use App\Utils\MessageResponse;
class RegistroDocenteCursosService {


    public function registroDocente($data) {

        $responseValidate = ValidateJsonRequest::validateJsonRequestRegistroDocenteCurso($data);
        if(count($responseValidate) > 0) {
            return $responseValidate;
        }

        $idPeriodo = $data['idPeriodo'];
        $rol = $data['rol'];
        $idDocente = $data['idDocente'];
        $idNivelCurso = $data['idNivelCurso'];

        
        $searchRegistroDocenteCurso = RegistroDocenteCurso::where('id_nivel_curso', $idNivelCurso)
            ->where('id_periodo', $idPeriodo)->get();
        if( count($searchRegistroDocenteCurso) > 3 ) {
            return MessageResponse::messageDescriptionError("Error", "No puede registrar mas de 3 docentes");
        }

        $searchRegistroDocenteCursoMentor = RegistroDocenteCurso::where('id_nivel_curso', $idNivelCurso)
            ->where('id_periodo', $idPeriodo)->where('rol', 'mentor')->get();

        if( count($searchRegistroDocenteCursoMentor) > 1 ) {
            return MessageResponse::messageDescriptionError("Error", "No puede registrar mas de 1 mentor");
        }

        $registroDocenteCurso = new RegistroDocenteCurso;
        $registroDocenteCurso->id_docente = $idDocente;
        $registroDocenteCurso->id_nivel_curso = $idNivelCurso;
        $registroDocenteCurso->id_periodo = $idPeriodo;
        $registroDocenteCurso->rol = $rol;
        $registroDocenteCurso->created_at = Carbon::now();
        $registroDocenteCurso->save();


        return MessageResponse::messageDescriptionError("Ok", "Guardado con exito");


    }

}

