<?php

namespace App\Service;

use App\Models\Curso;
use App\Models\CursoNivel;
use App\Models\Nivel;
use Exception;
use Illuminate\Support\Facades\DB;

class ConsultaNotasService {

    public function consultarNotasCursoNivelMesService($periodo, $curso_nivel, $mes){
        
        $cursoInfo = Curso::where('id', $curso_nivel->id_curso)->select('nombre_curso')->first();
        $nivelInfo = Nivel::where('id', $curso_nivel->id_nivel)->select('codigo_nivel')->first();
        $InfoGeneral = ['Curso' => $cursoInfo, 'Nivel' => $nivelInfo, 'Periodo' => $periodo->codigo_periodo, "Mes" => $mes->nombre_mes];

        $promedioTotal = [];

        $cargasAcademicas = DB::table("carga_academicas")
        ->select("carga_academicas.id", "alumnos.codigo_alumno", "alumnos.nombre_alumno", "alumnos.apellido_alumno")
        ->join('alumnos', 'carga_academicas.id_alumno', '=', 'alumnos.id')
        ->where('id_periodo', $periodo->id)
        ->where('id_curso_nivel', $curso_nivel->id)
        ->get();

        foreach($cargasAcademicas as $cargaActual){
            
            $actividades = CursoNivel::find($curso_nivel->id)
            ->actividades()
            ->where('id_periodo', $periodo->id)
            ->select('id', 'codigo_actividad', 'porcentaje_actividad')
            ->get();

            $promedioActual = 0;

            foreach($actividades as $actividad){
                $lineasActividad = $actividad->lineaActividad()->select('id', 'nombre_linea_actividad')->get();
                $notaAcumulada = 0.00;
                foreach($lineasActividad as $linea){
                    $notaLinea = DB::table('registro_notas')
                    ->select('registro_notas.nota')
                    ->join('curso_nivel_mes', 'curso_nivel_mes.id', '=', 'registro_notas.id_curso_nivel_mes')
                    ->join('mes', 'mes.id', '=', 'curso_nivel_mes.id_mes')
                    ->where('registro_notas.id_linea_actividad', $linea->id)
                    ->where('mes.id', $mes->id)
                    ->first()->nota;
                    
                    $notaAcumulada += floatval($notaLinea);
                }
                $actividad->notaTotal = round(($notaAcumulada / count($lineasActividad)), 2);
                $promedioActual = $promedioActual + ($actividad->notaTotal * (floatval($actividad->porcentaje_actividad / 100)));

            }

            $cargaActual->actividades = $actividades;
            $cargaActual->promedioActual = round($promedioActual, 2);
        }

        $respuesta = null;
        $respuesta['cargasAcademicas'] = $cargasAcademicas;
        //$respuesta['promedioTotal'] = $promedioTotal;
        $respuesta['infoGeneral'] = $InfoGeneral;

        return $respuesta;
    }

}