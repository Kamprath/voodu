<?php

Auth::routes();

Route::get('/', 'AppController@index');

Route::get('/board/{id}', 'AppController@board');

Route::get('/home', 'HomeController@index')->name('home');