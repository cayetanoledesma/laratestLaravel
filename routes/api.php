<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\AlumnoApiController;

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
Route::prefix('v1')->group(function(){
    //Todo lo que haya en este grupo se accedera escribiendo /api/v1/....lo que sea
    Route::post('login', [AuthController::class, 'authenticate']);

    Route::post('register', [AuthController::class, 'register']);
    
    Route::group(['middleware'=> ['jwt.verify']], function(){
        //Todo lo que haya en este grupo se refiere a autentication de usuario

        Route::post('logout', [AuthController::class, 'logout']);

        Route::post('get-user',[AuthController::class, 'getUser']);

        Route::get('alumnos', [AlumnoApiController::class, 'index']);

        Route::get('alumnos/{id}', [AlumnoApiController::class, 'show']);

        Route::post('alumnos', [AlumnoApiController::class, 'store']);

        Route::put('alumnos/{id}', [AlumnoApiController::class, 'update']);

        Route::delete('alumnos/{id}', [AlumnoApiController::class, 'destroy']);
    });
});


