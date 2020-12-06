<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Doctor;
use App\Http\Requests\UserRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        //save data in database
        $user = User::Create($request->validated())->profile()->create();
        if($user){
            return response()->json(['message' => 'ثبت نام با موفقیت انجام شد.'], 200);
        }else{
            return response()->json(['meesage' => 'ثبت نام انجام نشد.'], 422);
        }
    }
}
