<?php

namespace App\Http\Controllers;

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
}
