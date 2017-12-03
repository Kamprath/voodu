<?php

Auth::routes();

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
});

Route::get('/', 'AppController@index');

Route::get('/boards/{id}', 'AppController@index');