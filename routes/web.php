<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
    return view('home.index');
})->name('home');
Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";
});
Auth::routes();

Route::middleware(['auth'])
    ->group(function () {
        Route::get('appointment', 'Home\PatientController@appointment')->name('appointment');
        Route::post('postAppointment', 'Home\PatientController@postAppointment')->name('postAppointment');
        Route::get('profile', 'Home\PatientController@profile')->name('profile');
        Route::post('updateProfile', 'Home\PatientController@updateProfile')->name('updateProfile');

    });
