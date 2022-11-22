<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Curso;
use App\Models\CursoNivel;
use App\Models\Mes;
use App\Models\Nivel;
use App\Models\Periodo;
use App\Service\ConsultaNotasService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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

    public function consultaBoletaSabatina (Periodo $periodo, Alumno $alumno){
        return $this->consultaNotasService->consultaBoletaSabatinaService($periodo, $alumno);
    }

    public function notaAcumuladaPDF(Periodo $periodo, CursoNivel $curso_nivel, Mes $mes){
        return $this->consultaNotasService->consultarNotasCursoNivelMesServicePDF($periodo, $curso_nivel, $mes);
    }

}
