<?php

namespace App\Http\Controllers;

use App\Service\RegistroNotasService;
use Illuminate\Http\Request;

class RegistroNotasController extends Controller
{
    protected $registroNotasService;

    public function __construct(RegistroNotasService $registroNotasService)
    {
        $this->registroNotasService = $registroNotasService;
    }

    public function storeNota(Request $request)
    {
        $response = $this->registroNotasService->registrarNota($request->json()->all());
        return $response;
    }
}
