<?php

namespace App\Service;

use App\Models\CargaAcademica;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\CursoNivel;
use App\Models\RegistroNota;
use App\Utils\ValidateJsonRequest;
use App\Utils\MessageResponse;
use Carbon\Carbon;
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

    public function inscribirAlumno($data) {

        $responseValidate = ValidateJsonRequest::validateJsonRequestInscribirAlumnoCurso($data);
        if(count($responseValidate) > 0) {
            return $responseValidate;
        }

        $idPeriodo = $data['id_periodo'];
        $rol = $data['rol'];
        $idAlumno = $data['id_alumno'];
        $idNivelCurso = $data['id_curso_nivel'];


        $responseValidateLogicRegister = $this->validateLogicRegisterAlumnoCurso($idPeriodo, $idNivelCurso,
            $idAlumno, $rol, 1, 1);

        if(count($responseValidateLogicRegister) > 0) {
            return $responseValidateLogicRegister;
        }

        $periodoActivoBool = Periodo::find($idPeriodo);
        if(!$periodoActivoBool->activo_periodo) {
            return MessageResponse::messageDescriptionError("Error", "Error el periodo no esta activo");

        }
        
        $registroAlumnoCurso = new CargaAcademica;
        $registroAlumnoCurso->id_alumno = $idAlumno;
        $registroAlumnoCurso->id_nivel_curso = $idNivelCurso;
        $registroAlumnoCurso->id_periodo = $idPeriodo;
        $registroAlumnoCurso->rol = $rol;
        $registroAlumnoCurso->created_at = Carbon::now();
        $responseBolean = $registroAlumnoCurso->save();

        return MessageResponse::returnResponse($responseBolean);

    }

    private function validateLogicRegisterAlumnoCurso(
        $idPeriodo, 
        $idNivelCurso, 
        $idAlumno, 
        $rol, 
        $countUpdateAlumno,
        $countUpdateRol
    ) {
        
        $searchRegistroAlumnoCurso = CargaAcademica::where('id_nivel_curso', $idNivelCurso)
            ->where('id_periodo', $idPeriodo)->get();
        /* if(count($searchRegistroAlumnoCurso) > 3 ) {
            return MessageResponse::messageDescriptionError("Error", "No puede registrar mas de 3 docentes");
        } */

        /* if($rol == "mentor") {
            $searchRegistroDocenteCursoMentor = RegistroDocenteCurso::where('id_nivel_curso', $idNivelCurso)
                ->where('id_periodo', $idPeriodo)->where('rol', 'mentor')->get();

            if(count($searchRegistroDocenteCursoMentor) >= $countUpdateRol ) {
                return MessageResponse::messageDescriptionError("Error", "No puede registrar mas de 1 mentor");
            }
        } */

        $searchAlumno = CargaAcademica::where('id_alumno', $idAlumno)
            ->where('id_curso_nivel', $idNivelCurso)->where('id_periodo', $idPeriodo)->get();
        if(count($searchAlumno) >= $countUpdateAlumno) {
            return MessageResponse::messageDescriptionError("Error", "No se puede dos veces el mismo Alumno");
        }
        return [];

    }

    public function updateRegisterAlumnoCurso($jsonRequest, $registroAlumnoCurso) {
        $responseValidate = ValidateJsonRequest::validateJsonRequestInscribirAlumnoCurso($jsonRequest);
        if(count($responseValidate) > 0) {
            return $responseValidate;
        }

        $countUpdateAlumno = 1;
        $countUpdateRol = 1;
        if($registroAlumnoCurso->id_alumno == $jsonRequest['id_alumno']) {
            $countUpdateDocente = 2;
        }
        /* if($jsonRequest['rol'] == "mentor") {
            if($jsonRequest['rol'] == $registroDocenteCurso->rol) {
                $countUpdateRol = 2;Preguntar
            }
        } */

        $responseValidateLogic = $this->validateLogicRegisterAlumnoCurso(
            $jsonRequest['id_periodo'],
            $registroAlumnoCurso->id_nivel_curso,
            $jsonRequest['id_alumno'],
            $jsonRequest['rol'],
            $countUpdateAlumno,
            $countUpdateRol
        );
        
        if(count($responseValidateLogic) > 0) {
            return $responseValidateLogic;
        }

        $registroAlumnoCurso->id_alumno = $jsonRequest['id_alumno'];
        $registroAlumnoCurso->rol = $jsonRequest['rol'];
        $registroAlumnoCurso->updated_at = Carbon::now();
        $responseBool = $registroAlumnoCurso->update();
        return MessageResponse::returnResponse($responseBool);
    }

    public function getAllRegisterByAlumno($idAlumno, $idPeriodo) {
        $arrayPadre = [];
        $arrayHijo = [];

        $nivelsForDocentes = DB::table('registro_docente_cursos')
            ->select('nivels.nombre_nivel', 'nivels.id')
            ->join('curso_nivels', 'curso_nivels.id', '=', 'registro_docente_cursos.id_nivel_curso')
            ->join('nivels', 'nivels.id', '=', 'curso_nivels.id_nivel')
            ->where('registro_docente_cursos.id_docente', '=', $idDocente)
            ->where('registro_docente_cursos.id_periodo', '=', $idPeriodo)
            ->groupBy('nivels.id')
            ->get();

        foreach($nivelsForDocentes as $nivels) {
            $arrayHijo["nombre"] = $nivels->nombre_nivel;
            $a = DB::table('registro_docente_cursos')
            ->select('nivels.nombre_nivel', 
                'registro_docente_cursos.id as idRegistroCurso',
                'nivels.id as idNivel', 
                'curso_nivels.id as idCursoNivel', 
                'cursos.id as idCurso',
                'cursos.nombre_curso',
                'nivels.nombre_nivel'
            )
            ->join('curso_nivels', 'registro_docente_cursos.id_nivel_curso', '=', 'curso_nivels.id')
            ->join('cursos', 'curso_nivels.id_curso', '=', 'cursos.id')
            ->join('nivels', 'curso_nivels.id_nivel', '=', 'nivels.id')
            ->where('registro_docente_cursos.id_docente', '=', $idDocente)
            ->where('registro_docente_cursos.id_periodo', '=', $idPeriodo)
            ->where('nivels.id', '=', $nivels->id)
            ->get();
            $arrayHijo['values'] = $a;
            array_push($arrayPadre, $arrayHijo);
        }
        return $arrayPadre;

    }

}
