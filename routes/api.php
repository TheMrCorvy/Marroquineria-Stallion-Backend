<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-products', 'ProductController@get_products');

Route::get('/find-product', 'ProductController@find_product');

Route::get('/get-offers', 'ProductController@get_offers');

Route::post('/search-product', 'ProductController@search_product');

Route::post('/buy', 'SaleController@buy');

Route::post('/ask-for-fund', 'SaleController@ask_for_fund');

Route::get('/get-shipping-options', 'ShippingController@get_shipping_options');