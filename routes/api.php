<?php

use App\Models\Week;
use App\Models\Specialty;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MakeTurnController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserProfileController;
use App\Http\Controllers\API\DoctorProfileController;
use App\Http\Controllers\API\DoctorRegisterController;
use App\Http\Controllers\API\DoctorSpecialtyController;
use App\Http\Controllers\API\DoctorAvailableDaysController;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'api'], function () {
Route::get('test', function () {
    return response(['message' => 'user not auth'], 401);
})->name('verify');
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('doctor/register', [DoctorRegisterController::class, 'register']);
});
Route::group(['middleware' => 'jwt.verify'], function () {

    Route::post('changeDoctorStatus/{id}', function ($id) {
        $doctor = Doctor::where('user_id', $id)->first();
        if ($doctor != null && $doctor->is_active == 0) {
            $doctor->is_active = true;
            $doctor->save();
            return response(['حساب دکتر با موفقیت فعال شد'], 200);
        } else {
            $doctor->is_active = false;
            $doctor->save();
            return response(['حساب دکتر با موفقیت غیر فعال شد'], 200);
        }
    });
    Route::get('getDoctors', function () {
        $doctor = DB::table('users')
            ->join('doctors', 'users.id', '=', 'doctors.user_id')
            ->get(['users.id', 'users.name', 'users.family', 'users.phone', 'doctors.is_active']);
        return $doctor;
    });
    Route::get('getUser', function () {
        $user = auth('api')->user();
        
        $doctor = Doctor::select('id')->where('user_id', $user->id)->get();
        // $user = User::find($user->id);
        // if($doctor != null){
        //     $doctorProfile = $doctor->profile;
        // }else{
        //     $doctorProfile = null;
        // }
        // if($user != null){
        //     $userProfile = $user->profile;
        // }else{
        //     $userProfile = null;
        // }
        // return $doctor;
        // $u = User::where('id', $user->id)->with('profile')->first();
        $u = User::find($user->id)->with('profile')->first();
        // $u = User::find();
        
        // return $u;
        return response([
            'user' => [
                'user' => $u,
                // 'profile' =>  $doctor !== null ?  $doctorProfile : $userProfile
            ],
            'is_doctor' => $doctor->count() != 0 ? true : false,
            'is_active' => $doctor->count() != 0 ? auth('api')->user()->doctor->is_active : 0
        ], 200);
    });

    Route::group(['prefix' => 'doctor'], function () {
        Route::resource('profile', DoctorProfileController::class);
        Route::apiResources([
            'specialty' => DoctorSpecialtyController::class,
            'day' => DoctorAvailableDaysController::class,
        ]);
        Route::get('days', function () {
            return Week::all();
        });
        Route::get('specialites', function () {
            return Specialty::all();
        });
    });
    Route::group(['prefix' => 'user'], function () {
        Route::post('profile', [UserProfileController::class, 'storeOrUpdate']);
        Route::post('save-turn', [MakeTurnController::class, 'addTurn']);
    });
});
    
// });
