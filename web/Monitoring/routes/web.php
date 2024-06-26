<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
//car
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
// Route::get('/locations', [HomeController::class, 'getLocations']);

Route::get('/create_kendaraan',[HomeController::class,'create'])->name('car.create');
Route::post('/store_kendaraan',[HomeController::class,'store'])->name('car.store');

Route::get('/edit_kendaraan/{nopol}',[HomeController::class,'edit'])->name('car.edit');
Route::put('/update_kendaraan/{nopol}',[HomeController::class,'update'])->name('car.update');
Route::delete('/delete_kendaraan/{nopol}',[HomeController::class,'delete'])->name('car.delete');

//driver
Route::get('/data_driver',[DriverController::class,'index'])->name('driver.data');
Route::get('/create_driver',[DriverController::class,'create'])->name('driver.create');
Route::post('/store_driver',[DriverController::class,'store'])->name('driver.store');
Route::get('driver/data_driver',[DriverController::class,'search'])->name('driver.search');

Route::get('/edit_driver/{id}',[DriverController::class,'edit'])->name('driver.edit');
Route::put('/update_driver/{id}',[DriverController::class,'update'])->name('driver.update');
Route::delete('/delete_driver/{id}',[DriverController::class,'delete'])->name('driver.delete');

// Route::get('/task', [TaskController::class, 'task'])->name('task');

Route::resource('tasks', TaskController::class);
Route::put('/tasks/{task}/finish', [TaskController::class, 'finishTask'])->name('tasks.finish');
Route::resource('destinations', DestinationController::class);


});

// Route::group(['prefix' => 'superadmin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
//     Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
// });
