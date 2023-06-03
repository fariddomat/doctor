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

Route::get('/', 'Home\HomeController@index')->name('home');


Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    // shell_exec('composer update');
    return "Cleared!";
});

// Route::get('/migrate', function () {
//     Artisan::call('migrate:fresh --seed');
//     return "migrated!";
// });
Auth::routes();

Route::middleware(['auth'])
    ->group(function () {
        Route::get('appointment', 'Home\PatientController@appointment')->name('appointment');
        Route::get('updateAppointment/{id}', 'Home\PatientController@updateAppointment')->name('updateAppointment');
        Route::post('appointmentUpdate/{id}', 'Home\PatientController@appointmentUpdate')->name('appointmentUpdate');
        Route::delete('cancelAppointment/{id}', 'Home\PatientController@cancelAppointment')->name('cancelAppointment');

        Route::post('/appointment/time', 'Home\PatientController@appointmentTime')->name('appointment.time');
        Route::post('postAppointment', 'Home\PatientController@postAppointment')->name('postAppointment');
        Route::get('profile', 'Home\PatientController@profile')->name('profile');
        Route::post('updateProfile', 'Home\PatientController@updateProfile')->name('updateProfile');
        Route::post('updatePatient', 'Home\PatientController@updatePatient')->name('updatePatient');
    });
