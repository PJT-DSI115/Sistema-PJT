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
        $actividades = CursoNivel::find(1)->actividades()->select('id', 'nombre_actividad')
            ->where('id_curso_nivel', $cargaAcademica->id_curso_nivel)->get();
    
        foreach($actividades as $actividad){
            $lineas = $actividad->lineaActividad()->select('id', 'nombre_linea_actividad')->get();
            foreach($lineas as $linea){
                $linea['registroNotas'] = $linea->registroNota()->select('id', 'nota', 'id_linea_actividad')
                    ->where('id_carga_academica', $cargaAcademica->id)->get();
            }
            $actividad['lineaActividad'] = $lineas;
        }    

        return $actividades;
    }

}