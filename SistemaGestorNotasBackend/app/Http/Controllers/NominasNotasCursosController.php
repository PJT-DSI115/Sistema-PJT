<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Service\NominasNotasService;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NominasNotasCursosController extends Controller
{
    protected $nomina;

    public function __construct(NominasNotasService $nomina)
    {
        $this->nomina = $nomina;
    }

    public function nominaNotaCurso(Curso $curso){
        return $this->nomina->nominaNotaCursoService($curso);
    }

    public function nominaPdf(Curso $curso){
        return $this->nomina->nominaNotaCursoServicePDF($curso);
    }


}
