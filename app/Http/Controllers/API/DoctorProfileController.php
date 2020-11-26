<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorProfile;
use App\Models\TurnDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
     
     
     */
/*

public function store(Request $request)
    {

      


        $doctor = auth('api')->user();
        
        return $doctor;
        $dataUpdate = [];

        if ($request->hasFile('avatar')) {

            Storage::disk('public')->delete($doctor->profile->avatar);
            $dataUpdate['avatar'] = $request->file('avatar')->storePublicly('avatars', 'public');
        } else {
            $dataUpdate['avatar'] = $doctor->profile->avatar;
        }
        $dataUpdate['bio'] = $request->bio;
        $dataUpdate['age'] = $request->age;
            $doctor->profile()->updateOrCreate([
                'doctor_id' => $doctor->id
            ], $dataUpdate);
          
        return response("success", 200);
    }
*/

    public function store(Request $request)
    {

        $doctor = auth('api')->user()->doctor;
        
        // return $doctor;
        $dataUpdate = [];

        if ($request->hasFile('avatar')) {

            Storage::disk('public')->delete($doctor->profile->avatar);
            $dataUpdate['avatar'] = $request->file('avatar')->storePublicly('avatars', 'public');
        } else {
            $dataUpdate['avatar'] = $doctor->profile->avatar;
        }
        $dataUpdate['bio'] = $request->bio;
        $dataUpdate['age'] = $request->age;
            $doctor->profile()->updateOrCreate([
                'id' => $doctor->id
            ], $dataUpdate);
          
        return response("success", 200);
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



    // todo: move me.
    public function visitTime(){
        $turnDates = TurnDate::whereHas('turn', function($q){
            $q->where('doctor_id', auth('api')->user()->id);
        })->where('date','>=', Carbon::now()->timestamp )->get();

        // get detail

        // foreach ($turnDates as $key => $date) {
        //     $date->visitTime;
        // }
    }
}


