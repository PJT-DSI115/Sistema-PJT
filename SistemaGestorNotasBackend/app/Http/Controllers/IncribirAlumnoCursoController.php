<?php

namespace App\Http\Controllers;
use App\Models\Periodo;
use App\Models\CargaAcademica;
use App\Service\CargaAcademicaService;
use Illuminate\Http\Request;
use App\Utils\MessageResponse;
use App\Utils\AuthJwtUtils;

class IncribirAlumnoCursoController extends Controller
{
    protected $registroCargaAcademicaService;

    public function __construct(CargaAcademicaService $registroCargaAcademicaService) {
        $this->registroCargaAcademicaService = $registroCargaAcademicaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeInscribirAlumno(Request $request)
    {
        //
        $responseJson = $this->registroCargaAcademicaService->inscribirAlumno($request->json()->all());
        return $responseJson;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getRegisterByIdPeriodAndByIdNivelCurso(Request $request) {
        $idNivelCurso = $request->get('id_nivel_curso');
        $idPeriodo = $request->get('id_periodo');

        $periodo = Periodo::find($idPeriodo);
        $periodoActivo = $periodo->activo_periodo;

        $registers = CargaAcademica::where('id_nivel_curso', $idNivelCurso)
            ->where('id_periodo', $idPeriodo)->with('alumno')->get();

        foreach($registers as $register) {
            $register['activo'] = $periodoActivo;
        }
        return $registers;
    }


    public function deleteRegisterAlumnoCurso(CargaAcademica $registroAlumnoCurso) {
        $boolResponse = $registroAlumnoCurso->delete();

        return MessageResponse::returnResponse($boolResponse);

    }

    public function updateRegisterDocenteCurso(
        CargaAcademica $registroAlumnoCurso,
        Request $request
    ) {
        $jsonRequest = $request->json()->all();
        return $this->registroCargaAcademicaService
                             ->updateRegisterAlumnoCurso($jsonRequest, $registroAlumnoCurso);
    }

    public function getAllRegisterByAlumnoPeriodoCursoNivel(Request $request) {

        $jwt = AuthJwtUtils::getSubStringHeaderAuthorization($request->header('Authorization'));
        $user = AuthJwtUtils::getUserForJWT($jwt);
        $alumno = $user->alumno;
        $idPeriodo = $request->get('id_periodo');

        $responseNivels = $this->registroCargaAcademicaService
            ->getAllRegisterByDocente($alumno->id, $idPeriodo);

        return $responseNivels;
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
