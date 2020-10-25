<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'phone' => $request->phone,
            'password' => $request->password
        ];
        User::create($data);
    }
}
