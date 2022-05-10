<?php

namespace App\Http\Controllers;

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

        if($user->isEmpty()) {
        error_log("Entro aqui");
            $responseMessage["message"] = "The username or password is invalid";
            return response($responseMessage, 401);
        }

        if(!Hash::check($password, $user[0]->password)) {
            $responseMessage["message"] = "The username or password is invalid";
            return response($responseMessage, 401);
        }
        error_log($user);


        $payload = [
            "user" => $username,
            "role" => "prueba",
            "idUser" => $user[0]->id,
        ];
        error_log(env("SECRET_KEY"));

        $jwt = JWT::encode($payload, env("SECRET_KEY"), 'HS256');

        $credentials = [
            "jwt" => $jwt
        ];
        return $credentials;
    }
}
