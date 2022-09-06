<?php
/**
 * @author JS Martinez 
 * */
namespace App\Service;

use App\Mail\UserCreated;
use App\Models\Alumno;
use App\Models\Rol;
use App\Models\User;
use App\Utils\AuthJwtUtils;
use App\Utils\MessageResponse;
use App\Utils\ValidateJsonRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserService {

    private const STUDENT = "1";
    private const ALUMNO = "2";


    public function storeUser($data) {
        $responseValidate = ValidateJsonRequest::validateJsonRequestStoreTeach($data);
        if(count($responseValidate) > 0) {
            return $responseValidate;
        }

        if($data['user_type'] == self::STUDENT) {

            $student = Alumno::find($data['id_person']);
            if(!$student) {
                return response(
                MessageResponse::messageDescriptionError("Error", 
                    "Not Found"), 404);
            }
            if($student->id_user != null) {
                return response(
                    MessageResponse::messageDescriptionError("Error",
                    "Error ya existe un usuario para esta persona"),
                    200
                );
            }
            $rol = Rol::find($data['user_rol']);

            if(!$rol) {
                return response(
                    MessageResponse::messageDescriptionError("Error",
                    "Not Found"),
                    404
                );
            }
            $passwordGenerated = AuthJwtUtils::generatePasswordRandow();

            $user = new User();
            $user->username = $student->codigo_alumno;
            $user->password = Hash::make($passwordGenerated);
            $user->id_role = $rol->id;
            $responseSaveSuccessUser = $user->saveOrFail();
            if(!$responseSaveSuccessUser) {
                return response(
                    MessageResponse::messageDescriptionError("Error", 
                    "Error save failed"),
                    200
                );
            }
            $student->id_user = $user->id;
            $responseSaveSuccessStudent = $student->save();
            if(!$responseSaveSuccessStudent) {
                $user->delete();
                return response(
                    MessageResponse::messageDescriptionError("Error", 
                    "Error save failed"),
                    200
                );
            }

            Mail::to($student->email_alumno)
                ->send(new UserCreated($user, $student, $passwordGenerated));

            return response(
                MessageResponse::messageDescriptionError("Ok", "Save success"),
                200
            );
        }
        if($data['user_type'] == self::ALUMNO) {
            return "Sera para empleado";
        }

    }

    public function getAllUserByStudents() {
        $alumnos = DB::table('alumnos')
            ->select(
                'alumnos.nombre_alumno as nombre',
                'alumnos.apellido_alumno as apellido',
                'alumnos.fecha_nacimiento_alumno as fecha_nacimiento',
                'alumnos.photo_alumno as avatar',
                'users.username',
                'rols.nombre_rol as rol',
                'alumnos.id as id'
            )->join('users', 'users.id', '=', 'alumnos.id_user')
             ->join('rols', 'rols.id', '=', 'users.id_role')
            ->where('alumnos.id_user', '!=', null)->get();
        return $alumnos;
    }


    public function getAllUserByTeachers() {
        $teachers = DB::table('profesors')
        -> select(
            'profesors.nombre_profesor as nombre',
            'profesors.apellido_profesor as apellido',
            'profesors.fecha_nacimiento_profesor as fecha_nacimiento',
            'profesors.photo_profesor as avatar',
            'profesors.id as id',
            'rols.nombre_rol as rol',
        ) 
        ->join('users', 'users.id', '=', 'profesors.id_user')
        ->join('rols', 'rols.id', '=', 'users.id_role')
        ->where('profesors.id_user', '!=', null)->get();
        return $teachers;
    }

}

?>
