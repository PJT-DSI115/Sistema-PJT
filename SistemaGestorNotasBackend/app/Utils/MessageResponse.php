<?php

namespace App\Utils;
use Carbon\Carbon;

class MessageResponse {

    public static function messageDescriptionError($typeMessage, $descriptionMessage) {
        return  [
            "message" => $typeMessage,
            "descripcionMessage" => $descriptionMessage,
            "dateMessage" => Carbon::now()
        ];
    }
}



