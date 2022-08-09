<?php

namespace App\Service;

use App\Models\CargaAcademica;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\CursoNivel;

class CargaAcademicaService {

    public function getAllAlumnosByCarga($id_periodo, $id_curso_nivel){
        $cargaAcademica = CargaAcademica::select('id', 'id_alumno')
            ->where('id_periodo', $id_periodo)
            ->where('id_curso_nivel', $id_curso_nivel)->get();
        foreach($cargaAcademica as $carga){
            $carga['alumno'] = $carga->alumno()->select('codigo_alumno', 'nombre_alumno', 'apellido_alumno')->get();
        }
        return $cargaAcademica;
    }

    public function getAllLineaActividadByCursoNivel(CargaAcademica $cargaAcademica){
        $actividades = CursoNivel::find($cargaAcademica->id_curso_nivel)
            ->actividades()
            ->where('id_periodo', $cargaAcademica->id_periodo)
            ->select('id', 'nombre_actividad')->get();

        foreach($actividades as $actividad){
            $lineas = $actividad->lineaActividad()->select('id', 'nombre_linea_actividad')->get();
            foreach($lineas as $linea){
                $linea['registroNotas'] = $linea->registroNota()->select('id', 'nota', 'id_linea_actividad')
                    ->get();
            }

            $cursoNivelMes = CursoNivel::find($cargaAcademica->id_curso_nivel)->cursoNivelMes()->select('id_mes')
                ->get();

            foreach($cursoNivelMes as $curso){
                $curso['meses'] = $curso->mes()->select('id', 'codigo_mes')->get();
            }

            $actividad['lineaActividad'] = $lineas;
            $actividad['cursoNivelMes'] = $cursoNivelMes;
        }   
        
        $cursoNivelMes = CursoNivel::find($cargaAcademica->id_curso_nivel)->cursoNivelMes()->select('id')
            ->get();

        return $actividades;
    }

}