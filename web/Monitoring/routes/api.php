<?php

use App\Http\Controllers\ApitaskController;
use App\Http\Controllers\LoginflutterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [LoginFlutterController::class, 'login']);
Route::post('/fetchTugas', [ApitaskController::class, 'fetchTugas']);
Route::post('/acceptTugas', [ApitaskController::class, 'acceptTugas']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
