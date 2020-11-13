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

Route::group(['middleware' => 'api'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::post('register', [RegisterController::class, 'register']);
    });
    Route::group(['prefix' => 'doctor'], function () {
        Route::resource('profile', DoctorProfileController::class);
        Route::post('register', [DoctorRegisterController::class, 'register']);

        Route::apiResources([
            'specialty' => DoctorSpecialtyController::class,
            'day' => DoctorAvailableDaysController::class,
        ]);
        Route::get('days' , function(){
            return Week::all();
        });
        Route::get('specialites' , function(){
            return Specialty::all();
        });

    });
    Route::group(['prefix' => 'user'], function () {
        Route::post('profile', [UserProfileController::class, 'storeOrUpdate']);
        Route::get('save-turn', [MakeTurnController::class, 'addTurn']);
    });
});
