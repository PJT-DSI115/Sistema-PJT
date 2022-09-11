<?php
namespace App\Utils;

/**
 * @author JS Martinez
 */

use App\Utils\MessageResponse;


class ValidateJsonRequest {


    /**
     * @param Array $data
     * 
     * @return Array $responseMessage
     */
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

    /**
     * @param Array $data
     * 
     * @return Array $responseMessage
     */
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

    /**
     * @param Array $data
     * 
     * @return Array $responseMessage
     */
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

    public static function validateJasonRequestNota($data){
        if(!isset($data['id_curso_nivel_mes'])) {
            return MessageResponse::messageDescriptionError('Error',
            'Es necesario que elija un mes');
        }
        if(!isset($data['nota'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor nota es requerido');
        }

        return [];
    }


    public static function validateJsonRequestStoreTeach($data) {
        if(!isset($data['id_person'])) {
            return MessageResponse::messageDescriptionError('Error', 
                'El valor id_person es requerido');
        }
        if(!isset($data['user_rol'])) {
            return MessageResponse::messageDescriptionError('Error',
                'El valor de user_rol es requerido');
        }

        if(!isset($data['user_type'])) {
            return MessageResponse::messageDescriptionError('Error',
                'El valor de user_type es requerido');
        }
        return [];
    }

    public static function validateJsonRequestDeleteUser($data) {
        if(!isset($data['id_user'])) {
            return MessageResponse::messageDescriptionError('Error',
                'El valor id_user es requerido');
        }
        if(!isset($data['type_user'])){
            return MessageResponse::messageDescriptionError('Error',
                'El valor type_user es requerido');
        }
        return [];
    }
}

