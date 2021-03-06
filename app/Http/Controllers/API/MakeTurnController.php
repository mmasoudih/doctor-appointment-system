<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Turn;
use App\Models\TurnDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MakeTurnController extends Controller
{
    public function addTurn(Request $request){

        // make time stamp to date
        $date = Carbon::createFromTimestamp($request->date)->format('Y-m-d');

        $turnDate = TurnDate::firstOrCreate(
            ['date' =>  $date],
            ['date' => $date]
        );

        // get how many visitor have turn for current date and doctor.
        $howManyVisitor = Turn::where(['turn_date_id' => $turnDate->id, 'doctor_id' => $request->doctor_id])->count();


        $startTime = Carbon::parse($turnDate->date);
        $startTime = $startTime->setHours(8);// hospital will open at 8,
        $est = $howManyVisitor * 10; // each visitor will consume approximately 10 min
        $startTime->addMinutes($est);

        $turn = $turnDate->turns()->create($request->only("doctor_id")+['visit_time' => $startTime,'user_id' => auth('api')->user()->id]);

        return response()->json(['data' => $turn]);

    }

    public function removeTurn(Request $request){

    }
}
