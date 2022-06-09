<?php

namespace App\Service;

use App\Utils\AuthJwtUtils;
use Illuminate\Support\Facades\DB;

 class PeriodoService {


    public function getPeriodosByUsers($request) {

        $jwt = AuthJwtUtils::getSubStringHeaderAuthorization($request->header('Authorization'));
        $user = AuthJwtUtils::getUserForJWT($jwt);
        $rol = $user->rol;
        $registros = [];
        if($rol->codigo_rol == "2") {
            $professor = $user->professor;
            $registros = DB::table('registro_docente_cursos')
                ->select(
                    'registro_docente_cursos.id_periodo',
                    'periodos.codigo_periodo',
                    'periodos.id')
                    ->selectRaw('count(registro_docente_cursos.id_periodo) as Cuenta')
                ->join('periodos', 'periodos.id', '=', 'registro_docente_cursos.id_periodo')
                ->where('registro_docente_cursos.id_docente', '=', $professor->id)
                ->groupBy('id_periodo')
                ->get();
        }
        if($rol->codigo_rol == "3") {
            $alumno = $user->alumno;
            $registros = DB::table('carga_academicas')
                ->select('carga_academicas.id_periodo', 'periodos.codigo_periodo',
                'periodos.id')
                ->selectRaw('count(carga_academicas.id_periodo) as Cuenta')
                ->join('periodos', 'periodos.id', '=', 'carga_academicas.id_periodo')
                ->where('carga_academicas.id_alumno', '=', $alumno->id)
                ->groupBy('id_periodo')
                ->get();
        }
        if($rol->codigo_rol == "1") {
            $registros = DB::table('periodos')
                ->select('periodos.id', 'periodos.codigo_periodo')->get();
        }
        return $registros;
    }

}