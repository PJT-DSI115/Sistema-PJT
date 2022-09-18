<?php

namespace App\Service;

use App\Models\CargaAcademica;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\CursoNivel;
use App\Models\RegistroNota;
use Error;
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

    public function getAllLineaActividadByCursoNivel(CargaAcademica $cargaAcademica)
    {
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
                $suma_linea = 0;

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
                foreach ($linea->registro_notas as $n) {
                    $suma_linea += $n->nota;
                }
                $linea['promedio_nota'] = number_format(($suma_linea / count($meses)) * ($actividad["porcentaje_actividad"] / 100), 2);
            }

            /* $suma_actividad = DB::table('registro_notas')
            ->selectRaw(count(''))*/

            $actividad['lineaActividad'] = $lineas;
        }

        $pruebaUnion["actividades"] = $actividades;
        $pruebaUnion["meses"] = $meses;

        return $pruebaUnion;
    }


    public function getAllLineaActividadByCursoNivelMes($cargaAcademica, $mes)
    {
    }
}
