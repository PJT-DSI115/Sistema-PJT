<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class DocenteController extends Controller
{

    public function getAllDocentes() {
        return Profesor::all();
    }
    
    public function getDocenteById(Profesor $profesor) {
        return $profesor;
    }
}
