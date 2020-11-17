<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;
use App\Models\User;

class DoctorRegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        $user = User::Create($request->validated())->doctor()->create()->profile()->create();
        if($user){
            return response()->json(['message' => 'ثبت نام با موفقیت انجام شد.'], 200);
        }else{
            return response()->json(['meesage' => 'ثبت نام انجام نشد.'], 422);
        }
    }
}