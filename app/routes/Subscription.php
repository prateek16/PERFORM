<?php





Route::group(['prefix' => 'signup'], function()
{

    Route::get('/', [
        'before' => 'guest',
        'as' => 'signup',
        'uses' => 'SubscriptionController@index'
    ]);

    Route::post('register', [
        'before' => 'guest',
        'as' => 'register',
        'uses' => 'SubscriptionController@register'
    ]);

});
