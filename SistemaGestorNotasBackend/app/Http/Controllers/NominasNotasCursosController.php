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

    public function nominaPdf($curso){
        $ratios = DB::table('registro_notas')
        ->select('registro_notas.nota', 'registro_notas.id', 'alumnos.nombre_alumno', 'cursos.nombre_curso')
        ->join('carga_academicas','registro_notas.id_carga_academica', '=' , 'carga_academicas.id')
        ->join('alumnos','carga_academicas.id_alumno', '=' , 'alumnos.id')
        ->join('curso_nivels','carga_academicas.id_curso_nivel', '=' , 'curso_nivels.id')
        ->join('cursos','curso_nivels.id_curso', '=' , 'cursos.id')
        ->where('cursos.id', $curso)
        ->get();
        
        $pdf= PDF::loadView('pdf',['nomina'=> $ratios])->setPaper('a4', 'landscape')->setWarnings(false)->save('nomina.pdf');
        return $pdf->stream();
    }


}
