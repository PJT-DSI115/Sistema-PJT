<?php

namespace App\Http\Controllers;


use App\Models\RegistroDocenteCurso;
use App\Utils\MessageResponse;
use App\Service\RegistroDocenteCursosService;
use Illuminate\Http\Request;


class RegistroDocenteCursoController extends Controller
{

    protected $registroDocenteCursosService;

    public function __construct(RegistroDocenteCursosService $registroDocenteCursosService) {
        $this->registroDocenteCursosService = $registroDocenteCursosService;
    }

    public function storeRegisterProfessor(Request $request) {
        $responseJson = $this->registroDocenteCursosService
                             ->registroDocente($request->json()->all());
        return $responseJson;
    }

    public function getRegisterByIdPeriodAndByIdNivelCurso(Request $request) {
        $idNivelCurso = $request->get('idNivelCurso');
        $idPeriodo = $request->get('idPeriodo');

        $registers = RegistroDocenteCurso::where('id_nivel_curso', $idNivelCurso)
            ->where('id_periodo', $idPeriodo)->with('profesor')->get();

        return $registers;
    }

    public function deleteRegisterDocenteCurso(RegistroDocenteCurso $registroDocenteCurso) {
        $boolResponse = $registroDocenteCurso->delete();

        return MessageResponse::returnResponse($boolResponse);

    }

    public function updateRegisterDocenteCurso(
        RegistroDocenteCurso $registroDocenteCurso,
        Request $request
    ) {
        $jsonRequest = $request->json()->all();
        return $this->registroDocenteCursosService
                             ->updateRegisterDocenteCurso($jsonRequest, $registroDocenteCurso);
    }

}
