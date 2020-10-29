<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;
use App\Models\User;

class DoctorRegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        User::Create($request->validated())->doctor()->create()->doctorProfile()->create();
    }
}