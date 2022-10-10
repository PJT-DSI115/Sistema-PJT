<?php

namespace App\Http\Controllers;

use App\Models\CursoNivel;
use App\Models\Mes;
use App\Models\Periodo;
use App\Service\ConsultaNotasService;
use Illuminate\Http\Request;

class ConsultaNotasController extends Controller
{
    protected $consultaNotasService;

    public function __construct(ConsultaNotasService $consultaNotasService)
    {
        $this->consultaNotasService = $consultaNotasService;
    }

    public function consultarNotasCursoNivelMes (Periodo $periodo, CursoNivel $curso_nivel, Mes $mes){
        return $this->consultaNotasService->consultarNotasCursoNivelMesService($periodo, $curso_nivel, $mes);
    }
}
