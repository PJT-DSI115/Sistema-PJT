<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\RegistroDocenteCurso;
use App\Utils\AuthJwtUtils;
use App\Utils\MessageResponse;
use App\Service\PeriodoService; 
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
{
    protected $periodoService;

    public function __construct(PeriodoService $periodoService) 
    {
        $this->periodoService = $periodoService;
    }

    public function indexPeriod() {
        return Periodo::all();
    }

    public function show() {

    }

    public function storePeriod(Request $request) {
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

        return $this->returnResponse($responseBool);
    }

    public function updatePeriod(Request $request, Periodo $periodo) {
        $periodo->fecha_inicio_periodo = $request->post('fechaInicio');
        $periodo->fecha_fin_periodo = $request->post('fechaFin');
        $periodo->updated_at = Carbon::now();
        $responseBool = $periodo->update();
        return $this->returnResponse($responseBool);
    }

    public function changeStatePeriod(Request $request, Periodo $periodo) {
        $periodo->activo_periodo = $request->post('periodActive');

        $responseBool = $periodo->update();

        return $this->returnResponse($responseBool);
    }

    public function searchPeriodoActivo() {
        $periodo = Periodo::where('activo_periodo', '=', true)->first();
        if($periodo) {
            return $periodo;
        } else {
            return [
                "message" => "no"
            ];
        }
    }


    public function getAllPeriodosByUser(Request $request) {
        $registros = $this->periodoService->getPeriodosByUsers($request);
        return $registros;
    }


    private function returnResponse($responseBool) {
        if($responseBool) {
            return MessageResponse::messageDescriptionError("Ok", "Save Success");
        } else {
            return MessageResponse::messageDescriptionError("Error", "Save failed");
        }

    }

}

