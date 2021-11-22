<?php

use App\Http\Controllers\Admin\MoneyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\ScheduleController as PublicScheduleController;
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
    Route::get('/', [PublicScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/create', [PublicScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/', [PublicScheduleController::class, 'store'])->name('schedule.store');
    Route::delete('/{schedule}', [PublicScheduleController::class, 'destroy'])->name('schedule.destroy');
    Route::get('/appointments', [PublicScheduleController::class, 'getAppointments'])->name('schedule.appointments');
});

//rotas de autenticação
Auth::routes();

//home
Route::get('/home', [HomeController::class, 'index'])->name('home');


//admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'auth.admin'], function () {
    //Schedule
    Route::get('/dailySchedules', [AdminScheduleController::class, 'dailySchedules'])->name('admin.dailySchedules');
    Route::get('/', [AdminScheduleController::class, 'index'])->name('admin.index');
    Route::patch('toggleConfirm/{schedule}', [AdminScheduleController::class, 'toggleConfirm'])
        ->name('toggleConfirm');

    //Expanses
    Route::get('/expanses', [MoneyController::class, 'index'])->name('admin.expanses');
    Route::get('/expanses/create', [MoneyController::class, 'create'])->name('admin.expanses.create');
});



