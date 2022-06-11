<?php

/**
 * @author JS Martinez
 */
namespace App\Utils;
use Carbon\Carbon;

class MessageResponse {

    /**
     * @param string typeMessage
     * @param string descripcionMessage
     * 
     * @return Array responseMessage
     */
    public static function messageDescriptionError($typeMessage, $descriptionMessage) {
        return  [
            "message" => $typeMessage,
            "descripcionMessage" => $descriptionMessage,
            "dateMessage" => Carbon::now()
        ];
    }

    /**
     * @param bool $responseBool
     * @return Array $responseMessage
     */

    public static function returnResponse($responseBool) {
        if($responseBool) {
            return MessageResponse::messageDescriptionError("Ok", "Save Success");
        } else {
            return MessageResponse::messageDescriptionError("Error", "Save failed");
        }
    }
}



