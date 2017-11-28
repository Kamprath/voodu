<?php

Auth::routes();

Route::get('/', 'AppController@index');

Route::get('/boards/{id}', 'AppController@board');

Route::get('/home', 'HomeController@index')->name('home');