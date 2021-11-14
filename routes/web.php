<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HomeController;

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
Route::group(['prefix' => 'schedule', 'middleware' => 'auth'], function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::patch('toggleConfirm/{schedule}', [ScheduleController::class, 'toggleConfirm'])->name('schedule.toggleConfirm');
    Route::delete('/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    Route::get('/appointments', [ScheduleController::class, 'getAppointments'])->name('schedule.appointments');
});

//rotas de autenticação
Auth::routes();

//home
Route::get('/home', [HomeController::class, 'index'])->name('home');


//admin
Route::get('/admin', [ScheduleController::class, 'dailySchedules'])
    ->name('admin')->middleware('auth', 'auth.admin');

//
