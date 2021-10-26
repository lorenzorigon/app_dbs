<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/home');
})->middleware('auth');


//Schedule routes
Route::group(['prefix' => 'schedule'], function () {
    Route::get('/', [App\Http\Controllers\ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/create', [App\Http\Controllers\ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/', [App\Http\Controllers\ScheduleController::class, 'store'])->name('schedule.store');
    Route::patch('toggleConfirm/{schedule}', [App\Http\Controllers\ScheduleController::class, 'toggleConfirm'])->name('schedule.toggleConfirm');
    Route::delete('/{schedule}', [App\Http\Controllers\ScheduleController::class, 'destroy'])->name('schedule.destroy');

    Route::get('/appointments', [App\Http\Controllers\ScheduleController::class, 'getAppointments'])->name('schedule.appointments');
});

//rotas de autenticação
Auth::routes();

//home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin
Route::get('/admin', [App\Http\Controllers\ScheduleController::class, 'dailySchedules'])
    ->name('admin')->middleware('auth', 'auth.admin');

//
