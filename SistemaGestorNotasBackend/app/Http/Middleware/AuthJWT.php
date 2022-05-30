<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use DomainException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        $header = $request->header("authorization");
        $headerArray = substr($header, 7);
        if(!$header) {
            $errorResponse = $this->getMessageDescription("Authorization", 401,
            "Username or Password incorrect");
            return response($errorResponse, 401)
                ->header('Content-Type', 'application/json');
        }

        $key = env("SECRET_KEY");
        try
        {
            $decoded = JWT::decode((string)$headerArray, new Key($key, 'HS256'));

        } catch(DomainException $domainException) {
            error_log($domainException);
            $errorResponse = $this->getMessageDescription("Error", 500,
            "Error ");
            return response($errorResponse, 401)
                ->header('Content-Type', 'application/json');

        }
        $user = User::find($decoded->idUser);
        if(!$user) {
            $errorResponse = $this->getMessageDescription("Authorization", 401,
            "Username or Password incorrect");
            return response($errorResponse, 401)
                ->header('Content-Type', 'application/json');
        }

        if($user->rol->nombre_rol != $decoded->nombreRole) {
            $errorResponse = $this->getMessageDescription("Forbidden", 403, "Permissions denied");
            return response($errorResponse, 403)
                ->header('Content-Type', 'application/json');
            
        }

        $request->setJson($user);

        return $next($request, $user);
    }

    /**
     * @param string $type                  Type for message 
     * @param int $statusCode               Status code HTTP
     * @param string $messageDescription    Description for message
     * @return array $messageDescription
    */
    private function getMessageDescription($type, $statusCode, $messageDescription) {
        return [
                "error" => $type,
                "status" => $statusCode,
                "timestamp" => Carbon::now()
            ];

    }
}
