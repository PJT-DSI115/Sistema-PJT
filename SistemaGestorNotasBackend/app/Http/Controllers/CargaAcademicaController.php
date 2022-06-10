<?php

namespace App\Http\Controllers;

use App\Service\CargaAcademicaService;
use Illuminate\Http\Request;

class CargaAcademicaController extends Controller
{
    protected $cargaAcademicaService;

    public function __construct(CargaAcademicaService $cargaAcademicaService)
    {
        $this->cargaAcademicaService = $cargaAcademicaService;
    }

    public function indexAlumnosByCarga($id_periodo, $id_curso_nivel){
        $response = $this->cargaAcademicaService->getAllAlumnosByCarga($id_periodo, $id_curso_nivel);
        return $response;
    }
}
