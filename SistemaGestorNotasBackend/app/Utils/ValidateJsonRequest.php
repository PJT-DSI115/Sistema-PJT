<?php
namespace App\Utils;

use App\Utils\MessageResponse;


class ValidateJsonRequest {

    public static function validateJsonRequestRegistroDocenteCurso($data) {

        if(!isset($data['idNivelCurso'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor idNivelCurso es requerido');

        }
        if(!isset($data['idPeriodo'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor idPeriodo es requerido');
        }
        if(!isset($data['idDocente'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor idDocente es requerido');
        }

        return [];
    }

    public static function validateJasonRequestActividad($data){
        if(!isset($data['nombre_actividad'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor nombre_actividad es requerido');

        }
        if(!isset($data['codigo_actividad'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor codigo_actividad es requerido');
        }
        if(!isset($data['id_curso_nivel'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor id_curso_nivel es requerido');
        }
        if(!isset($data['id_periodo'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor id_periodo es requerido');
        }
        if(!isset($data['numero_actividades'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor numero_actividades es requerido');
        }
        if(!isset($data['porcentaje_actividad'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor porcentaje_actividad es requerido');
        }

        return [];
    }

    public static function validateJasonRequestActividadUpdate($data){
        if(!isset($data['nombre_actividad'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor nombre_actividad es requerido');

        }
        if(!isset($data['codigo_actividad'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor codigo_actividad es requerido');
        }
        if(!isset($data['porcentaje_actividad'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor porcentaje_actividad es requerido');
        }

        return [];
    }
}

