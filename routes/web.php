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
    return redirect(route('login'));
});

Route::group(['middleware' => ['auth', 'verified']], function (){
   Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
   Route::resource('users', \App\Http\Controllers\UserController::class);
});

Route::post('/initiate-call', [\App\Http\Controllers\TwilioController::class, 'initiateCall'])->name('twilio.initiate-call');

Route::post('/outbound/{salesPhone}', [\App\Http\Controllers\TwilioController::class, 'connectCall'])->name('twilio.outbound-call');

Route::get('click-to-call', [\App\Http\Controllers\UserController::class, 'clickToCall'])->name('click-to-call');
