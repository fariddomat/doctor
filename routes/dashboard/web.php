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

    });
