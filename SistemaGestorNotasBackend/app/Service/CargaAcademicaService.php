<?php

namespace App\Service;

use App\Models\CargaAcademica;
use App\Models\CursoNivel;
use App\Models\RegistroNota;
use Exception;
use Illuminate\Support\Facades\DB;

class CargaAcademicaService
{

    public function getAllAlumnosByCarga($id_periodo, $id_curso_nivel)
    {
        $cargaAcademica = CargaAcademica::select('id', 'id_alumno')
            ->where('id_periodo', $id_periodo)
            ->where('id_curso_nivel', $id_curso_nivel)->get();
        foreach ($cargaAcademica as $carga) {
            $carga['alumno'] = $carga->alumno()->select('codigo_alumno', 'nombre_alumno', 'apellido_alumno')->get();
        }
        return $cargaAcademica;
    }

    public function getAllAlumnosForBoleta($periodo){
        
        return DB::table('carga_academicas')
        ->select('alumnos.id', 'alumnos.codigo_alumno', 'alumnos.nombre_alumno', 'alumnos.apellido_alumno')
        ->distinct()
        ->join('alumnos', 'alumnos.id', '=', 'carga_academicas.id_alumno')
        ->where('carga_academicas.id_periodo', $periodo->id)
        ->get();
    }

    public function getAllLineaActividadByCursoNivel(CargaAcademica $cargaAcademica)
    {
        $infoGeneral = DB::table('carga_academicas')
            ->select('alumnos.codigo_alumno', 'alumnos.nombre_alumno', 'alumnos.apellido_alumno', 'periodos.codigo_periodo', 'cursos.nombre_curso', 'nivels.nombre_nivel')
            ->join('alumnos', 'carga_academicas.id_alumno', '=', 'alumnos.id')
            ->join('periodos', 'carga_academicas.id_periodo', '=', 'periodos.id')
            ->join('curso_nivels', 'carga_academicas.id_curso_nivel', '=', 'curso_nivels.id')
            ->join('cursos', 'curso_nivels.id_curso', '=', 'cursos.id')
            ->join('nivels', 'curso_nivels.id_nivel', '=', 'nivels.id')
            ->where('carga_academicas.id', $cargaAcademica->id )
            ->first();

        $actividades = CursoNivel::find($cargaAcademica->id_curso_nivel)
            ->actividades()
            ->where('id_periodo', $cargaAcademica->id_periodo)
            ->select('id', 'nombre_actividad', 'porcentaje_actividad')
            ->get();

        $pruebaUnion = null;

        $meses = DB::table('curso_nivel_mes')
            ->select('curso_nivel_mes.id_mes', 'mes.codigo_mes', 'curso_nivel_mes.id')
            ->join('mes', 'curso_nivel_mes.id_mes', '=', 'mes.id')
            ->where('id_curso_nivel', $cargaAcademica->id_curso_nivel)
            ->get();

        foreach ($actividades as $actividad) {
            $lineas = $actividad->lineaActividad()->select('id', 'nombre_linea_actividad')->get();
            foreach ($lineas as $linea) {

                $validarNota = DB::table('registro_notas')
                    ->select("registro_notas.nota")
                    ->where('registro_notas.id_linea_actividad', $linea->id)
                    ->get();

                if (count($validarNota) <= 0) {
                    for ($j = 0; $j < count($meses); $j++) {
                        $nota = new RegistroNota;
                        $nota->nota = 0.0;
                        $nota->id_linea_actividad = $linea->id;
                        $nota->id_curso_nivel_mes = $meses[$j]->id;
                        $nota->id_carga_academica = $cargaAcademica->id;
                        try {
                            $nota->save();
                        } catch (Exception $ex) {
                            error_log($ex->getMessage());
                        }
                    }
                }

                $linea['registro_notas'] = DB::table('registro_notas')
                    ->select('registro_notas.id', 'registro_notas.nota', 'curso_nivel_mes.id_mes', 'mes.codigo_mes')
                    ->join('linea_actividads', 'registro_notas.id_linea_actividad', '=', 'linea_actividads.id')
                    ->join('curso_nivel_mes', 'registro_notas.id_curso_nivel_mes', '=', 'curso_nivel_mes.id')
                    ->join('mes', 'curso_nivel_mes.id_mes', '=', 'mes.id')
                    ->where('id_linea_actividad', $linea->id)
                    ->get();
            }

            /* $suma_actividad = DB::table('registro_notas')
            ->selectRaw(count(''))*/

            $actividad['lineaActividad'] = $lineas;
        }

        $pruebaUnion["actividades"] = $actividades;
        $pruebaUnion["meses"] = $meses;
        $pruebaUnion["infoGeneral"] = $infoGeneral;

        return $pruebaUnion;
    }


    public function getAllLineaActividadByCursoNivelMes($cargaAcademica, $mes)
    {
    }
}
