<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Utils\MessageResponse;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        error_log("Entra aqui");
        return Curso::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        error_log("prueba");
        //Guardar cursos.
        $codigoCurso = $request->post('codigo_curso');
        $nombreCurso = $request->post('nombre_curso');

        error_log($codigoCurso);
        error_log($nombreCurso);

        $curso = new Curso();
        $curso->codigo_curso = $codigoCurso;
        $curso->nombre_curso = $nombreCurso;

        $responseBool = $curso->save();
        return $this->returnResponse($responseBool);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        error_log("Esta es una prueba para el show");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        //Actualizar.
        $curso->codigo_curso = $request->post('codigo_curso');
        $curso->nombre_curso = $request->post('nombre_curso');

        $responseBool = $curso->update();
        return $this->returnResponse($responseBool);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminar.
        $curso = Curso::destroy($id);
        return $curso;
    }

    private function returnResponse($responseBool) {
        if($responseBool) {
            return MessageResponse::messageDescriptionError("Ok", "Save Success");
        } else {
            return MessageResponse::messageDescriptionError("Error", "Save failed");
        }

    }
}
