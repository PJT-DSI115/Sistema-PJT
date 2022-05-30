<?php

namespace App\Http\Controllers;

use App\Models\CursoNivel;
use App\Service\RegistroDocenteCursos;
use Illuminate\Http\Request;


class RegistroDocenteCursoController extends Controller
{

    protected $registroDocenteCursos;

    public function __construct(RegistroDocenteCursos $registroDocenteCursos) {
        $this->registroDocenteCursos = $registroDocenteCursos;
    }


    public function prueba() {
        $data = "Esta es una prueba";
        $this->registroDocenteCursos->registroDocente($data);
    }

    public function indexPrueba() {
        $cursoNivel = CursoNivel::first();
        $cursoNivel->curso;
        $cursoNivel->nivel;
        return $cursoNivel;
    }
}
