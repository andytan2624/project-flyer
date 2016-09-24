<?php

Route::get('/', 'PagesController@home');

Route::resource('flyers', 'FlyersController');

Route::get('{zip}/{street}', 'FlyersController@show');

Route::post('{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'FlyersController@addPhoto']);
Route::auth();

Route::get('/home', 'HomeController@index');

Route::delete('photos/{id}', 'FlyersController@destroy');