<?php

namespace App\Service;

use App\Models\Profesor;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Carbon\Carbon;
use Exception;

class DocenteService{

    public function crearProfesor($requestInfo){
        $profesor = new Profesor;
        $validateInfo = ValidateJsonRequest::validateJsonRequestDocenteNew($requestInfo);
        if(count($validateInfo) > 0){
            return $validateInfo;
        }

        $profesor->nombre_profesor = $requestInfo["nombre_profesor"];
        $profesor->apellido_profesor = $requestInfo["apellido_profesor"];
        $profesor->fecha_nacimiento_profesor = $requestInfo["fecha_nacimiento_profesor"];
        $profesor->dui_profesor = $requestInfo["dui_profesor"];
        $profesor->codigo_profesor = $requestInfo["codigo_profesor"];
        $profesor->email_profesor = $requestInfo["email_profesor"];
        $profesor->created_at = Carbon::now();

        try{
            $responseBool = $profesor->save();
            return MessageResponse::returnResponse($responseBool);
        }
        catch(Exception $ex){
            error_log($ex->getMessage());
        }
    }
}