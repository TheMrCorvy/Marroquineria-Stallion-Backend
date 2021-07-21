<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::post('/login', 'AdminController@login')->name('login.form');

    Route::view('/login', 'welcome')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::view('/home', 'dashboard')->name('home');

    Route::get('/logout', 'AdminController@logout')->name('logout');

    Route::group(['prefix' => 'product'], function () {
        Route::post('/create', 'ProductController@create')->name('product.create');

        Route::post('/edit/{id}', 'ProductController@edit')->name('product.edit');

        Route::get('/delete/{id}', 'ProductController@delete')->name('product.delete');
    });
});
