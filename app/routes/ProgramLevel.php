<?php


Route::group(['prefix' => 'admin/programs', 'before' => array('auth','csrf-ajax')], function()
{

    Route::get('deleteProgram',[
        'as' => 'deleteProgram',
        'uses' => 'AdminController@deleteProgram'
    ]);

     Route::get('renameProject',[
        'as' => 'renameProject',
        'uses' => 'AdminController@renameProject'
    ]);

       Route::get('submitIssue',[
        'as' => 'submitIssue',
        'uses' => 'AdminController@submitIssue'
    ]);





});

