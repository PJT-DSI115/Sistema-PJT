<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Utils\MessageResponse;


class NivelController extends Controller
{
    //Mostrar Niveles.
    public function index() {
        return Nivel::all();
    }

    public function store(Request $request)
    {
        $json = $request->json()->all();
        error_log("pruebaStore");
        //Guardar Niveles.
        $codigoNivel = $json['codigo_nivel'];
        $nombreNivel = $json['nombre_nivel'];
        
        error_log($request->post('codigo_nivel'));
        error_log($nombreNivel);

        $nivel = new Nivel();
        $nivel->codigo_nivel = $codigoNivel;
        $nivel->nombre_nivel = $nombreNivel;

        $responseBool = $nivel->save();
        return $this->returnResponse($responseBool);
    }

    //Mostrar un nivel especifico.
    public function show($codigoNivel) {
        $nivel = Nivel::where('codigo_nivel', '=', $codigoNivel)->get();
        return $nivel;
    }

    public function update(Request $request, Nivel $nivel)
    {
        //Actualizar Nivel.
        $json = $request->json()->all();
        error_log("Entra aqui");
        error_log($json['codigo_nivel']);    
        $nivel->codigo_nivel = $json['codigo_nivel'];
        $nivel->nombre_nivel = $json['nombre_nivel'];
        // error_log($request->post('codigo_curso'));
        $responseBool = $nivel->update();
        return $this->returnResponse($responseBool);
    }

    public function destroy($id)
    {
        //Eliminar Nivel.
        $nivel = Nivel::destroy($id);
        if($nivel == 1)
        {
            return $this->returnResponse(true);
        }else{
            return $this->returnResponse(false);
        }
        
    }

    // public function store(Request $request) {
    //     if($request->header('Content-Type')!== 'application/json') {
    //         return $responseMessage = [
    //             "DescripccionError" => "Debe de enviar datos permitidos",
    //             "Error" => "E",
    //             "Fecha" => Carbon::now()
    //         ];

    //     }
    //     $responseMessage = [];
    //     if(!$request->post('codigo_nivel')) {
    //         return $responseMessage = [
    //             "DescripccionError" => "El codigo de el nivel es obligatorio",
    //             "Error" => "E",
    //             "Fecha" => Carbon::now()
    //         ];

    //     }

    // }

    private function returnResponse($responseBool) {
        if($responseBool) {
            return MessageResponse::messageDescriptionError("Ok", "Save Success");
        } else {
            return MessageResponse::messageDescriptionError("Error", "Save failed");
        }

    }

}
