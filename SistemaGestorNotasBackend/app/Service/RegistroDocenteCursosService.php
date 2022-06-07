<?php

namespace App\Service;

use App\Models\Periodo;
use App\Models\RegistroDocenteCurso;
use Carbon\Carbon;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Illuminate\Support\Facades\DB;
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

        $periodoActivoBool = Periodo::find($idPeriodo);
        if(!$periodoActivoBool->activo_periodo) {
            return MessageResponse::messageDescriptionError("Error", "Error el periodo no esta activo");

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


    public function getAllRegisterByDocente($idDocente, $idPeriodo) {
        $responseNivels = [];
        $arrayPadre = [];
        $arrayValue = [];
        $arrayHijo = [];

        $nivelsForDocentes = DB::table('registro_docente_cursos')
            ->select('nivels.nombre_nivel', 'nivels.id')
            ->join('curso_nivels', 'curso_nivels.id', '=', 'registro_docente_cursos.id_nivel_curso')
            ->join('nivels', 'nivels.id', '=', 'curso_nivels.id_nivel')
            ->where('registro_docente_cursos.id_docente', '=', $idDocente)
            ->where('registro_docente_cursos.id_periodo', '=', $idPeriodo)
            ->groupBy('nivels.id')
            ->get();

        foreach($nivelsForDocentes as $nivels) {
            $arrayHijo["nombre"] = $nivels->nombre_nivel;
            $a = DB::table('registro_docente_cursos')
            ->select('nivels.nombre_nivel', 
                'registro_docente_cursos.id as idRegistroCurso',
                'nivels.id as idNivel', 
                'curso_nivels.id as idCursoNivel', 
                'cursos.id as idCurso',
                'cursos.nombre_curso',
                'nivels.nombre_nivel'
            )
            ->join('curso_nivels', 'registro_docente_cursos.id_nivel_curso', '=', 'curso_nivels.id')
            ->join('cursos', 'curso_nivels.id_curso', '=', 'cursos.id')
            ->join('nivels', 'curso_nivels.id_nivel', '=', 'nivels.id')
            ->where('registro_docente_cursos.id_docente', '=', $idDocente)
            ->where('registro_docente_cursos.id_periodo', '=', $idPeriodo)
            ->where('nivels.id', '=', $nivels->id)
            ->get();
            $arrayHijo['values'] = $a;
            array_push($arrayPadre, $arrayHijo);
        }
        return $arrayPadre;

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

        $searchDocente = RegistroDocenteCurso::where('id_docente', $idDocente)
            ->where('id_nivel_curso', $idNivelCurso)->where('id_periodo', $idPeriodo)->get();
        if( count($searchDocente) >= $countMentor) {
            return MessageResponse::messageDescriptionError("Error", "No se puede dos veces el mismo maestro");
        }
        return [];

    }


}

