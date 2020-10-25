<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;


class RegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        $isValid  = $request->validated();
        return $isValid;
    }
}
