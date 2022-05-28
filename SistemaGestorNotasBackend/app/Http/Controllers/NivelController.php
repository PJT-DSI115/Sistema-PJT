<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function index() {
        return Nivel::all();
    }

    public function show($codigoNivel) {
        $nivel = Nivel::where('codigo_nivel', '=', $codigoNivel)->get();
        return $nivel;
    }

    public function store(Request $request) {
        if($request->header('Content-Type')!== 'application/json') {
            return $responseMessage = [
                "DescripccionError" => "Debe de enviar datos permitidos",
                "Error" => "E",
                "Fecha" => Carbon::now()
            ];

        }
        $responseMessage = [];
        if(!$request->post('codigo_nivel')) {
            return $responseMessage = [
                "DescripccionError" => "El codigo de el nivel es obligatorio",
                "Error" => "E",
                "Fecha" => Carbon::now()
            ];

        }

    }

}
