<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::post('/login', 'AdminController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::view('/home', 'dashboard')->name('home');

    Route::get('/logout', 'AdminController@logout')->name('logout');

    Route::group(['prefix' => 'product'], function () {
        Route::post('/create', 'ProductController@create')->name('product.create');
    });
});
