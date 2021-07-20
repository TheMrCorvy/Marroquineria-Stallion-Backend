<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::post('/login', 'AdminController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/logout', 'AdminController@logout')->name('logout');
});
