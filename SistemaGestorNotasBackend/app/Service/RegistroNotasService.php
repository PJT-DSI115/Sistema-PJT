<?php

namespace App\Service;

use App\Models\CargaAcademica;
use App\Models\RegistroNota;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;


class RegistroNotasService {

    public function registrarNota($data){

        $responseValidate = ValidateJsonRequest::validateJasonRequestNota($data);
        if(count($responseValidate) > 0){
            return $responseValidate;
        }

        $id_carga_academica = $data['id_carga_academica'];
        $id_linea_actividad = $data['id_linea_actividad'];
        $id_curso_nivel_mes = $data['id_curso_nivel_mes'];
        $nota = $data['nota'];

        $responseNotaMes = RegistroNota::where('id_carga_academica', $id_carga_academica)
            ->where('id_linea_actividad', $id_linea_actividad)
            ->where('id_curso_nivel_mes', $id_curso_nivel_mes)->get();
        if(count($responseNotaMes) >= 1){
            return MessageResponse::messageDescriptionError('Error', 'Ya ha registrado la nota!');
        }

        if((float)$nota > 10.00 || (float)$nota < 0.00){
            return MessageResponse::messageDescriptionError('Error', 'La nota debe ser menor o igual a 10, o mayor o igual a 0');
        }

        $registroNota = new RegistroNota;

        $registroNota->id_carga_academica = $id_carga_academica;
        $registroNota->id_linea_actividad = $id_linea_actividad;
        $registroNota->id_curso_nivel_mes = $id_curso_nivel_mes;
        $registroNota->nota = (float)$nota;
        $registroNota->created_at = Carbon::now();
        $responseBool = $registroNota->save();

        return MessageResponse::returnResponse($responseBool);
    }

    public function editarNota(Request $request, $data){
        
    }
}