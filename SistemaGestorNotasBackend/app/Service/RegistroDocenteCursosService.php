<?php

namespace App\Service;

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

        $responseValidateLogicRegister = $this->validateLogicRegisterDocentes($idPeriodo, $idNivelCurso,
            $idDocente, $rol, "save");

        if(count($responseValidateLogicRegister) > 0) {
            return $responseValidateLogicRegister;
        }
        
        $registroDocenteCurso = new RegistroDocenteCurso;
        $registroDocenteCurso->id_docente = $idDocente;
        $registroDocenteCurso->id_nivel_curso = $idNivelCurso;
        $registroDocenteCurso->id_periodo = $idPeriodo;
        $registroDocenteCurso->rol = $rol;
        $registroDocenteCurso->created_at = Carbon::now();
        $responseBolean = $registroDocenteCurso->save();

        return MessageResponse::returnResponse($responseBolean);

    }


    public function updateRegisterDocenteCurso($jsonRequest, $registroDocenteCurso) {
        $responseValidate = ValidateJsonRequest::validateJsonRequestRegistroDocenteCurso($jsonRequest);
        if(count($responseValidate) > 0) {
            return $responseValidate;
        }

        $responseValidateLogic = $this->validateLogicRegisterDocentes(
            $jsonRequest['idPeriodo'],
            $registroDocenteCurso->id_nivel_curso,
            $jsonRequest['idDocente'],
            $jsonRequest['rol'],
            "update"
        );
        
        if(count($responseValidateLogic) > 0) {
            return $responseValidateLogic;
        }

        $registroDocenteCurso->id_docente = $jsonRequest['idDocente'];
        $registroDocenteCurso->rol = $jsonRequest['rol'];
        $registroDocenteCurso->updated_at = Carbon::now();
        $responseBool = $registroDocenteCurso->update();
        return MessageResponse::returnResponse($responseBool);
    }


    private function validateLogicRegisterDocentes($idPeriodo, $idNivelCurso, $idDocente, $rol, $type) {
        $countMentor = 2;
        if($type == "save") {
            $countMentor = 1;
        }
        $searchRegistroDocenteCurso = RegistroDocenteCurso::where('id_nivel_curso', $idNivelCurso)
            ->where('id_periodo', $idPeriodo)->get();
        if( count($searchRegistroDocenteCurso) > 3 ) {
            return MessageResponse::messageDescriptionError("Error", "No puede registrar mas de 3 docentes");
        }

        if($rol == "mentor") {
            $searchRegistroDocenteCursoMentor = RegistroDocenteCurso::where('id_nivel_curso', $idNivelCurso)
                ->where('id_periodo', $idPeriodo)->where('rol', 'mentor')->get();

            if( count($searchRegistroDocenteCursoMentor) >= $countMentor ) {
                return MessageResponse::messageDescriptionError("Error", "No puede registrar mas de 1 mentor");
            }
        }

        $searchDocente = RegistroDocenteCurso::where('id_docente', $idDocente)->get();
        if( count($searchDocente) >= $countMentor) {
            return MessageResponse::messageDescriptionError("Error", "No se puede dos veces el mismo maestro");
        }
        return [];

    }


}

