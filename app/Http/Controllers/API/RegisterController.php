<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        //create instanse of models 
        $doctor = new Doctor;
        $user = new User;
        
        //save data in database 
        $user->name = $request->name;
        $user->family = $request->family;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $result = $user->save();

        //get registered id 
        $id = $user->id;
        
        
        if( $request->doctor ){
            $doctor->user_id = $id;
            $doctor->save();
            return response()->json(['message' => 'ثبت نام با موفقیت انجام شد.'], 200);
        }


        if($result){
            return response()->json(['message' => 'ثبت نام با موفقیت انجام شد.'], 200);
        }else{
            return response()->json(['meesage' => 'ثبت نام انجام نشد.'], 422);
        }
    }
}
