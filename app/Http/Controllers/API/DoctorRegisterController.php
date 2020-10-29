<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorRegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        // $user = User::Create($request->validated());

        // Doctor::Create([
        //     'user_id' => $user
        // ]);
        return 1111;
    }
}
