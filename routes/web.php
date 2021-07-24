<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'welcome')->name('welcome');

    Route::post('/login', 'AdminController@login')->name('login.form');

    Route::view('/login', 'welcome')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'AdminController@dashboard')->name('home');

    Route::get('/logout', 'AdminController@logout')->name('logout');

    Route::post('/change-password', 'AdminController@change_password')->name('change_password');

    Route::group(['prefix' => 'product'], function () {
        Route::post('/create', 'ProductController@create')->name('product.create');

        Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');

        Route::post('/update/{id}', 'ProductController@update')->name('product.update');

        Route::get('/delete/{id}', 'ProductController@delete')->name('product.delete');
    });

    Route::group(['prefix' => 'shipping_method'], function () {
        Route::post('/create', 'ShippingController@create_method')->name('shipping_method.create');

        Route::post('/update/{method_id}', 'ShippingController@update_method')->name('shipping_method.update');

        Route::get('/delete/{method_id}', 'ShippingController@delete_method')->name('shipping_method.delete');
    });

    Route::group(['prefix' => 'shipping_zone'], function () {
        Route::post('/create', 'ShippingController@create_zone')->name('shipping_zone.create');

        Route::post('/update/{zone_id}', 'ShippingController@update_zone')->name('shipping_zone.update');

        Route::get('/delete/{zone_id}', 'ShippingController@delete_zone')->name('shipping_zone.delete');
    });
});
