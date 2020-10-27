<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];
        //save data in database
        $user = User::Create($data);

        //get registered id
        $id = $user->id;

        if( $request->doctor ){
            Doctor::Create(['user_id' => $id]);
            return response()->json(['message' => 'ثبت نام با موفقیت انجام شد.'], 200);
        }

        if($user){
            return response()->json(['message' => 'ثبت نام با موفقیت انجام شد.'], 200);
        }else{
            return response()->json(['meesage' => 'ثبت نام انجام نشد.'], 422);
        }
    }
}
