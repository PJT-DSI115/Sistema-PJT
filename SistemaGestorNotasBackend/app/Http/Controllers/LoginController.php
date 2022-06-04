<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request) {
        $responseMessage = [

        ];

        $username = $request->post('username');
        $password = $request->post('password');
        $user = User::where('username', $username)->get();
        error_log($user);
        if($user->isEmpty()) {
            $responseMessage["message"] = "The username or password is invalid";
            return response($responseMessage, 401);
        }

        if(!Hash::check($password, $user[0]->password)) {
            $responseMessage["message"] = "The username or password is invalid";
            return response($responseMessage, 401);
        }


        $payload = [
            "user" => $username,
            "role" => $user[0]->rol->id_role,
            "nombreRole" => $user[0]->rol->nombre_rol,
            "idUser" => $user[0]->id,
        ];

        $jwt = JWT::encode($payload, env("SECRET_KEY"), 'HS256');

        $credentials = [
            "jwt" => $jwt,
            "nombreRol" => $user[0]->rol->nombre_rol,
            "idRol" => $user[0]->rol->id,
            'id' => $user[0]->id
        ];
        return $credentials;
    }
}
