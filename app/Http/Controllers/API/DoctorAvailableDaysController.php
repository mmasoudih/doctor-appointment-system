<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorAvailableDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $available_days = auth('api')->user()->doctor->availableDays->all();
        // $a = Doctor::find($available_days)->availableDays->all();
        return $available_days;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctor = auth('api')->user()->doctor;

        // return $doctor->availableDays()->create([
        //     'doctor_id' => $doctor->id,
        //     'week_day_id' => $request->week_day_id,
        //     'start_time' =>  $request->start_time,
        //     'end_time' => $request->end_time,
        // ]);
        // $r = [];
        foreach ($request->all() as $day) {
            $doctor->availableDays()->updateOrcreate(
                [
                    'week_day_id' => $day['id'],
                ],
                [
                    'week_day_id' => $day['id'],
                    'start_time' =>  $day['start_time'],
                    'end_time' => $day['end_time'],
                ]
            );
        }
        // return $r;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
