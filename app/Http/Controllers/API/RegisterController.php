<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegister;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    public function register(UserRegister $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->family = $request->family;
        $user->phone = $request->phone;
        $user->password = Crypt::encryptString($request->password);
        
        return $user->save() ?
            response()->json(['message' => 'ثبت نام با موفقیت انجام شد.'], 200) :
            response()->json(['meesage' => 'ثبت نام انجام نشد.'], 422);
    }
}
