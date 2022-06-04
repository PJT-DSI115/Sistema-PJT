<?php

namespace App\Service; 

use App\Models\Actividad;
use App\Models\LineaActividad;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Carbon\Carbon;

class ActividadService {

    public function traerActividades () {

        $actividades = Actividad::all();
        foreach($actividades as $actividad){
            $linea_actividad = $actividad->lineaActividad()->get()->count();
            $actividad['numero_actividades'] = $linea_actividad;
        }
        return $actividades;
    }

    public function registrarActividad ($data){

        $responseValidate = ValidateJsonRequest::validateJasonRequestActividad($data);
        if(count($responseValidate) > 0){
            return $responseValidate;
        }

        $nombre_actividad = $data['nombre_actividad'];
        $codigo_actividad = $data['codigo_actividad'];
        $porcentaje_actividad = $data['porcentaje_actividad'];
        $id_curso_nivel = $data['id_curso_nivel'];
        $id_periodo = $data['id_periodo'];
        $numero_actividades = (int)$data['numero_actividades'];

        $responseValidateDuplicate = Actividad::where("codigo_actividad", $codigo_actividad)
            ->where("id_curso_nivel", $id_curso_nivel)
            ->where("id_periodo", $id_periodo)->get();
        if(count($responseValidateDuplicate) == 1){
            return MessageResponse::messageDescriptionError('Error', 'La actividad ya existe para la materia, nivel y periodo');
        }

        if($codigo_actividad === "CE"){
            if($numero_actividades > 1){
                return MessageResponse::messageDescriptionError('Error', 'No puede haber más de una actividad Examen');
            }
        }
        
        if($numero_actividades > 10){
            return MessageResponse::messageDescriptionError('Error', 'No puede ingresar más de 10 actividades');
        }

        $actividad = new Actividad;
        $actividad->nombre_actividad = $nombre_actividad;
        $actividad->codigo_actividad = $codigo_actividad;
        $actividad->porcentaje_actividad = $porcentaje_actividad;
        $actividad->id_curso_nivel = $id_curso_nivel;
        $actividad->id_periodo = $id_periodo;
        $actividad->created_at = Carbon::now();
        $responseBool = $actividad->save();
        $responseBoolCount = 0;
        for($i=1; $i<=$numero_actividades; $i++){
            $linea_actividad = new LineaActividad;
            $linea_actividad->codigo_linea_actividad = $codigo_actividad.(string)$i;
            $linea_actividad->nombre_linea_actividad = $nombre_actividad.(string)$i;
            $linea_actividad->id_actividad = $actividad->id;
            $responseBoolChild = $actividad->lineaActividad()->save($linea_actividad);
            if(!$responseBoolChild){
                $responseBoolCount++;
            }
        }

        if($responseBoolCount > 0){
            return MessageResponse::messageDescriptionError('Error', "Elimine la actividad ya que $responseBoolCount de $numero_actividades actividades se guardaron únicamente!");
        }

        return MessageResponse::returnResponse($responseBool);
    }

    public function actualizarActividad ($data, Actividad $actividad) {
        $responseValidate = ValidateJsonRequest::validateJasonRequestActividadUpdate($data);
        if(count($responseValidate) > 0){
            return $responseValidate;
        }

        $nombre_actividad = $data['nombre_actividad'];
        $codigo_actividad = $data['codigo_actividad'];
        $porcentaje_actividad = $data['porcentaje_actividad'];

        $responseBoolean = 0;
        $responseCodigo = Actividad::where("codigo_actividad", "!=", $actividad->codigo_actividad)->get();
        for($i=0; $i<count($responseCodigo); $i++){
            if($responseCodigo[$i]->codigo_actividad === $codigo_actividad){
                $responseBoolean++;
            }
        }
        
        if($responseBoolean > 0){
            return MessageResponse::messageDescriptionError('Error', 'La actividad ya existe, seleccione otra');
        }

        $actividad->nombre_actividad = $nombre_actividad;
        $actividad->codigo_actividad = $codigo_actividad;
        $actividad->porcentaje_actividad = $porcentaje_actividad;
        $actividad->updated_at = Carbon::now();
        $responseBool = $actividad->update();

        return MessageResponse::returnResponse($responseBool);
    }

    public function borrarActividad (Actividad $actividad){
        //eliminar hijos primero
        $actividad->lineaActividad()->where('id_actividad', $actividad->id)->delete();
        //ahora eliminar la actividad
        $responseBool = $actividad->where('id', $actividad->id)->delete();
        return MessageResponse::returnResponse($responseBool);
    }

}