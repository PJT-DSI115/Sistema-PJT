<?php
namespace App\Utils;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use DomainException;

class AuthJwtUtils {

    public static function getSubStringHeaderAuthorization($headerAuthorization) {
        return substr($headerAuthorization, 7);
    }


    public static function getUserForJWT($jwt) {
        $key = env("SECRET_KEY");
        try {
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
            $user = User::find($decoded->idUser);
            return $user;
        } catch(DomainException $domainExection) {
            return null;
        }

    }
}