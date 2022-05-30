<?php

namespace App\Http\Controllers;

use App\Models\CursoNivel;
use Illuminate\Http\Request;

class CursoNivelController extends Controller
{
    public function getCursosByNivel($id) {
        $cursoNivel = CursoNivel::where('id_nivel', $id)->with(['curso', 'nivel'])->get();
        return $cursoNivel;
    }
}
