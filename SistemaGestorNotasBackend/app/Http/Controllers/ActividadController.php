<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\LineaActividad;
use App\Utils\MessageResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Actividad::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actividad = new Actividad;
        $actividad->nombre_actividad = $request->post("nombre_actividad");
        $actividad->codigo_actividad = $request->post("codigo_actividad");
        $actividad->porcentaje_actividad = $request->post("porcentaje_actividad");
        $actividad->id_curso_nivel = $request->post("id_curso_nivel");
        $actividad->id_periodo = $request->post("id_periodo");
        $cant = (int)$request->post('numero_actividades');
        $response = $actividad->save();
        for($i=1; $i<=$cant; $i++){
            $linea_actividad = new LineaActividad;
            $linea_actividad->codigo_linea_actividad = $request->post("codigo_actividad").(string)$i;
            $linea_actividad->nombre_linea_actividad = $request->post("nombre_actividad").(string)$i;
            $linea_actividad->id_actividad = $actividad->id;
            $actividad->lineaActividad()->save($linea_actividad);
        }

        return $this->returnResponse($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = Actividad::where("id", $id)->get();
        return $actividad;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        $actividad->nombre_actividad = $request->post("nombre_actividad");
        $actividad->codigo_actividad = $request->post("codigo_actividad");
        $actividad->porcentaje_actividad = $request->post("porcentaje_actividad");
        $actividad->updated_at = Carbon::now();
        $requestBool = $actividad->update();
        return $this->returnResponse($requestBool);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        $responseBool = $actividad->delete();
        return $this->returnResponse($responseBool);
    }

    private function returnResponse($responseBool) {
        if($responseBool) {
            return MessageResponse::messageDescriptionError("Ok", "Save Success");
        } else {
            return MessageResponse::messageDescriptionError("Error", "Save failed");
        }

    }

  /*  public function getActividadByCursoNivelPeriodo($curso_nivel, $periodo){
        
        $actividad = Actividad

    }*/
}
