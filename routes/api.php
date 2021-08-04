<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-products/{type?}', 'ProductController@get_products');

Route::get('/find-product/{product_id}', 'ProductController@find_product');

Route::get('/get-offers', 'ProductController@get_offers');

Route::post('/search-products/{no_pagination?}', 'ProductController@search_products');

Route::post('/buy', 'SaleController@buy');

Route::post('/ask-for-fund', 'SaleController@ask_for_fund');

Route::get('/get-shipping-options', 'ShippingController@get_shipping_options');
