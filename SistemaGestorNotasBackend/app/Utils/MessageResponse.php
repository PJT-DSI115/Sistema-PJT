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

    public static function returnResponse($responseBool) {
        if($responseBool) {
            return MessageResponse::messageDescriptionError("Ok", "Save Success");
        } else {
            return MessageResponse::messageDescriptionError("Error", "Save failed");
        }
    }
}



