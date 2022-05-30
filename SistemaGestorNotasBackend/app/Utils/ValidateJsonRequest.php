<?php
namespace App\Utils;

use App\Utils\MessageResponse;


class ValidateJsonRequest {

    public static function validateJsonRequestRegistroDocenteCurso($data) {


        if(!$data['idCurso'] || $data['idCurso'] == '') {
            return MessageResponse::messageDescriptionError('Error',
            'El valor idCurso es requerido');
        }
        return [];
    }

}

