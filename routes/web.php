<?php

Auth::routes();

Route::get('/', 'AppController@index');

Route::get('/tasks', 'AppController@tasks');

Route::get('/board/{board}', 'AppController@board');

Route::get('/home', 'HomeController@index')->name('home');