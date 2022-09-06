<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }


    public function getAllUserByStudents() { 
        return $this->userService->getAllUserByStudents();
    }

    public function getAllUserByTeachers() {
        return $this->userService->getAllUserByTeachers();
    }

    public function storeUser(Request $request) {
        $dataJson = $request->json()->all();
        return $this->userService->storeUser($dataJson);

    }

}
