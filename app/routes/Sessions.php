<?php


    Route::post('login',[
        'before' => 'guest',
        'as' => 'login',
        'uses' => 'SessionsController@login'
    ]);




Route::get('logout',[
    'before' => 'auth',
    'as' => 'logout',
    'uses' => 'SessionsController@destroy'
]);