<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{

    public function index() {
        return Periodo::all();
    }

    public function show() {

    }

    public function store(Request $request) {
        $jsonResponse = [];

        $fechaInicio = $request->post('fechaInicio');
        $fechaFin = $request->post('fechaFin');
        $codigoPeriodo = "P" . "-" . Carbon::now()->format('Y');
        error_log($fechaFin);
        error_log($fechaInicio);
        error_log($codigoPeriodo);

        $periodo = new Periodo();
        $periodo->codigo_periodo = $codigoPeriodo;
        $periodo->fecha_inicio_periodo = $fechaInicio;
        $periodo->fecha_fin_periodo = $fechaFin;
        $periodo->activo_periodo = true;
        $responseBool = $periodo->save();
        if($responseBool) {
            $jsonResponse = [
                "Error" => "Ok",
                "Message" => "Guardado correctamente",
                "Date" => Carbon::now()
            ];

            return $jsonResponse;
        } else {
            $jsonResponse = [
                "Error" => "Error",
                "Message" => "No guardado correctamente",
                "Date" => Carbon::now()
            ];
            return $jsonResponse;

        }
    }

    public function update(Request $request) {

    }
}
