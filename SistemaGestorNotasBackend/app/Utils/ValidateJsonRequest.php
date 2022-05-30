<?php
namespace App\Utils;

use App\Utils\MessageResponse;


class ValidateJsonRequest {

    public static function validateJsonRequestRegistroDocenteCurso($data) {

        if(!isset($data['idCurso'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor idCurso es requerido');

        }
        if(!isset($data['idPeriodo'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor idPeriodo es requerido');
        }
        if(!isset($data['idNivel'])) {
            return MessageResponse::messageDescriptionError('Error',
            'El valor idNivel es requerido');
        }
        return [];
    }

}

