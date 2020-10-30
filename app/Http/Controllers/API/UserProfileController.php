<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    /*
register :: http://127.0.0.1:8000/api/auth/register

get Token(login) :: http://127.0.0.1:8000/api/auth/login

http://127.0.0.1:8000/api/user/profile
*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request)
    {
        //BIG D INC Copyright 2020 
        // BIG D (Pro)
        
        $user = auth('api')->user();
        //atom d :`-( GPL V3 2020
        $dataUpdate = [];
        if ($request->hasFile('avatar')) {

            Storage::disk('public')->delete($user->profile->avatar);
            $dataUpdate['avatar'] = $request->file('avatar')->storePublicly('avatars', 'public');
        } else {
            $dataUpdate['avatar'] = $user->profile->avatar;
        }
        $dataUpdate['bio'] = $request->bio;
        $user->profile()->updateOrCreate([
            'user_id' => $user->id
        ], $dataUpdate);
        return response()->json(
            "پروفایل با موفقیت به روز شد."
            ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
