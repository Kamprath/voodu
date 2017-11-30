<?php

Auth::routes();

Route::get('/', 'AppController@index');

Route::get('/boards/{id}', 'AppController@index');