<?php

namespace App\Http\Controllers;

use App\Models\CursoNivel;
use App\Service\RegistroDocenteCursosService;
use Illuminate\Http\Request;


class RegistroDocenteCursoController extends Controller
{

    protected $registroDocenteCursosService;

    public function __construct(RegistroDocenteCursosService $registroDocenteCursosService) {
        $this->registroDocenteCursosService = $registroDocenteCursosService;
    }



    public function storeRegisterProfessor(Request $request) {

        $jsonRequest = $request->json()->all();
        $responseJson = $this->registroDocenteCursosService
                             ->registroDocente($request->json()->all());

        return $responseJson;

    }

    public function prueba() {
        error_log("Prueba");
        $cursoNivel = CursoNivel::where('id_nivel', 1)->with(['curso', 'nivel'])->get();
        return $cursoNivel;
    }
}
