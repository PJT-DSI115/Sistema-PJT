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

}

