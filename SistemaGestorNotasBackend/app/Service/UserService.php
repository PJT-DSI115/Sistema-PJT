<?php
/**
 * @author JS Martinez 
 * */
namespace App\Service;

use App\Models\Alumno;
use App\Models\Rol;
use App\Models\User;
use App\Utils\AuthJwtUtils;
use App\Utils\MessageResponse;
use App\Utils\ValidateJsonRequest;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

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

            $user = new User();
            $user->username = $student->codigo_alumno;
            $user->password = Hash::make(AuthJwtUtils::generatePasswordRandow());
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
            return response(
                MessageResponse::messageDescriptionError("Ok", "Save success"),
                200
            );
        }
        if($data['user_type'] == self::ALUMNO) {
            return "Sera para empleado";
        }

    }

}

?>
