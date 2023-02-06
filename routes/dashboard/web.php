<?php

use Illuminate\Support\Facades\Route;


Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'role:doctor'])
    ->group(function () {

        Route::get('home', function () {
            return view('dashboard.layouts.site');
        })->name('home');

        Route::resource('users', 'UserController');
        Route::post('ban/{id}', 'UserController@ban')->name('users.ban');
        Route::post('unban/{id}', 'UserController@unban')->name('users.unban');

        Route::get('profile', 'HomeController@profile')->name('profile');
        Route::post('updateProfile', 'HomeController@updateProfile')->name('updateProfile');

        Route::resource('types', 'TypeController');
        Route::resource('dateOfWorks', 'DateOfWorkController');
        Route::resource('appointments', 'AppointmentController');
        Route::resource('patients', 'PatientController');

        Route::get('images', 'SettingController@images')->name('images');
        Route::post('updateImages', 'SettingController@updateImages')->name('updateImages');
        Route::get('about', 'SettingController@about')->name('about');
        Route::get('social', 'SettingController@social')->name('social');
        Route::get('services', 'SettingController@services')->name('services');
        Route::post('settings', 'SettingController@settings')->name('settings');
        Route::get('log', 'SettingController@log')->name('log');


    });
