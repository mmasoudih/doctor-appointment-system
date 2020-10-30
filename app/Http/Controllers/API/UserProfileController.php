<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserProfileController extends Controller
{
   


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request)
    {
      

        $user = auth('api')->user();
    
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

   
}
