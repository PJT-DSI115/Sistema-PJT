<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Alumno;
use App\Models\CursoNivel;
use Illuminate\Support\Str;
use App\Models\RegistroNota;

class RecordNotasController extends Controller
{
    public function recordGlobal(Alumno $student)
    {
        $student_id = $student->id;

        /*$courses = CursoNivel::whereHas('cargaAcademica', function($load_query) use ($student_id) {
            $load_query->where('id_alumno', $student_id);
        })->get();*/

        $courses = Curso::whereHas('cursoNivel', function($nivel_builder) use ($student_id) {
            $nivel_builder->whereHas('cargaAcademica', function($load_query) use ($student_id) {
                $load_query->where('id_alumno', $student_id);
            });
        })->get();

        $res = $courses->reduce(function($a, Curso $c) use ($student_id) {
            $course_id = $c->id;

            $grades = RegistroNota::whereHas('cargaAcademica', function($load_query) use ($course_id, $student_id) {
                $load_query->whereHas('cursoNivel', function($course_query) use ($course_id) {
                    $course_query->where('id_curso', $course_id);
                })->where('id_alumno', $student_id);
            })->get();

            $activityRes = $grades->reduce(function($sum, RegistroNota $g) {
                $calc = $g->nota * $g->lineaActividad()->first()->actividad()->first()->porcentaje_actividad;
                return $sum + $calc;
            }, 0);

            return array_merge($a, [$c->nombre_curso => $activityRes]);
        }, []);

        return response()->json($res);
    }
}
