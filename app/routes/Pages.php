<?php


Route::get('/', [
    'before' => 'guest',
    'as' => 'home',
    'uses' => 'PagesController@index'
]);



