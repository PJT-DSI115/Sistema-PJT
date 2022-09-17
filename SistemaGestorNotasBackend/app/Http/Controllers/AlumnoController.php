<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CursoNivel;
use App\Models\Periodo;
use App\Service\AlumnoService;
use App\Utils\MessageResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{

    protected $alumnoService;

    public function __construct(AlumnoService $alumnoService)
    {
        $this->alumnoService = $alumnoService;
    }

    public function index()
    {
        return $this->alumnoService->traerAlumnos();
    }

    public function store(Request $request)
    {

        $alumno1 = new Alumno();
        $alumno1->codigo_alumno = "RG54542";
        $alumno1->nombre_alumno = "Jennifer Alejandra";
        $alumno1->apellido_alumno = "Rivas Gomez";
        $alumno1->email_alumno = "jennifer@gmail.com";
        $alumno1->id_categoria_alumno = 1;
        $alumno1->nombre_encargado_alumno = "Jenniffer Gomez";
        $alumno1->fecha_nacimiento_alumno = Carbon::createFromDate(2005,10,6,'America/El_Salvador');
        $alumno1->created_at = Carbon::now();
        $alumno1->nie_alumno = "345321234";
        $alumno1->save();

        $alumno2 = new Alumno();
        $alumno2->codigo_alumno = "RL10967";
        $alumno2->nombre_alumno = "Jennifer Alejandra";
        $alumno2->apellido_alumno = "Rivera Lopez";
        $alumno2->email_alumno = "rivera@gmail.com";
        $alumno2->id_categoria_alumno = 1;
        $alumno2->nombre_encargado_alumno = "Jenniffer Gomez";
        $alumno2->fecha_nacimiento_alumno = Carbon::createFromDate(2005,10,6,'America/El_Salvador');
        $alumno2->created_at = Carbon::now();
        $alumno2->nie_alumno = "9821233";
        $alumno2->save();

        $alumno3 = new Alumno();
        $alumno3->codigo_alumno = "GG54542";
        $alumno3->nombre_alumno = "Cesar Alejandro";
        $alumno3->apellido_alumno = "Gomez Gomez";
        $alumno3->email_alumno = "alejandro@gmail.com";
        $alumno3->id_categoria_alumno = 1;
        $alumno3->nombre_encargado_alumno = "Alejandro Gomez";
        $alumno3->fecha_nacimiento_alumno = Carbon::createFromDate(2005,10,6,'America/El_Salvador');
        $alumno3->created_at = Carbon::now();
        $alumno3->nie_alumno = "56893";
        $alumno3->save();

        $alumno4 = new Alumno();
        $alumno4->codigo_alumno = "DD54542";
        $alumno4->nombre_alumno = "Miguel Angel";
        $alumno4->apellido_alumno = "Duran Duran";
        $alumno4->email_alumno = "miguel@gmail.com";
        $alumno4->id_categoria_alumno = 1;
        $alumno4->nombre_encargado_alumno = "Miguel Duran";
        $alumno4->fecha_nacimiento_alumno = Carbon::createFromDate(2005,10,6,'America/El_Salvador');
        $alumno4->created_at = Carbon::now();
        $alumno4->nie_alumno = "87553";
        $alumno4->save();
        return MessageResponse::messageDescriptionError("Ok", "Success");
    }

    
    public function show(Alumno $alumno)
    {
        return $alumno;
    }

    
    public function update(Request $request, Alumno $alumno)
    {
        error_log($alumno);
        error_log($request['nombre_alumno']);
        return $this->alumnoService->modificarAlumno($request, $alumno);
    }

    
    public function destroy(Alumno $alumno)
    {
        return $this->alumnoService->eliminarAlumno($alumno);
    }

    //public function boletaNotas(Periodo $periodo, CursoNivel $cursoNivel)
}
