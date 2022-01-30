<?php

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TramiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//! ** Usuarios **
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('users', [UserController::class, 'index']);

//! ** Post **
Route::get('posts', [PostController::class, 'index']);

//! ** Tramites **
Route::apiResource('tramites', TramiteController::class);

//! ** Config **
Route::get('config/{id}', [SettingController::class, 'show']);

Route::group(['middleware' => ["auth:sanctum"]], function () {

    //! ** Usuario **
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::put('users/{usuario}', [UserController::class, 'update']);
    Route::delete('users/{usuario}', [UserController::class, 'remove']);
    Route::get('users/email/{email}', [UserController::class, 'userByEmail']);
    Route::get('users/{usuario}', [UserController::class, 'show']);

    //! ** Setting **
    Route::apiResource('config', SettingController::class)->except('index', 'destroy', 'show');

    //! ** Asistencias **
    Route::apiResource('asistencias', AsistenciaController::class)->except('destroy');
    Route::get('/users/usuarios-asistencias/{usuario}', [AsistenciaController::class, 'myAsistencia']);
    Route::post('/users/usuarios-asistencias-fecha/{usuario}', [AsistenciaController::class, 'asistenciasByUserForFehca']);

    //! ** Post **
    Route::apiResource('posts', PostController::class)->except('index');
});
