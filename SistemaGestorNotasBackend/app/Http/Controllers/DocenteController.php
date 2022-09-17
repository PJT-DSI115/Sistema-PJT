<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Service\DocenteService;
use Illuminate\Http\Request;

class DocenteController extends Controller
{

    protected $docenteService;

    public function __construct(DocenteService $docenteService)
    {
        $this->docenteService = $docenteService;
    }

    public function getAllDocentes() {
        return Profesor::all();
    }
    
    public function getDocenteById(Profesor $profesor) {
        return $profesor;
    }

    public function store(Request $request){
        return $this->docenteService->crearProfesor($request);
    }
}
