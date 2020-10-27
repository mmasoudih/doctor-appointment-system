<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'family' => $request->family,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ];
        User::create($data);
    }
}
