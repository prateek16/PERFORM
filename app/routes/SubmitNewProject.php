<?php


Route::group(['prefix' => 'admin/newProject', 'before' => array('auth','csrf-ajax')], function()
{

    Route::get('submitStep1',[
        'as' => 'submitStep1',
        'uses' => 'SubmitNewProjectController@step1'
    ]);

    Route::get('submitStep2',[
        'as' => 'submitStep2',
        'uses' => 'SubmitNewProjectController@step2'
    ]);

    Route::get('submitStep3',[
        'as' => 'submitStep3',
        'uses' => 'SubmitNewProjectController@step3'
    ]);

    Route::get('submitStep3_1',[
        'as' => 'submitStep3_1',
        'uses' => 'SubmitNewProjectController@step3_1'
    ]);

    Route::get('submitStep4_q_m',[
        'as' => 'submitStep4_q_m',
        'uses' => 'SubmitNewProjectController@step4_q_m'
    ]);

    Route::get('submitStep5',[
        'as' => 'submitStep5',
        'uses' => 'SubmitNewProjectController@step5'
    ]);

    Route::get('submitStep6',[
        'as' => 'submitStep6',
        'uses' => 'SubmitNewProjectController@step6'
    ]);

    Route::get('submitStep9',[
        'as' => 'submitStep9',
        'uses' => 'SubmitNewProjectController@step9'
    ]);

    Route::get('submitStep10',[
        'as' => 'submitStep10',
        'uses' => 'SubmitNewProjectController@step10'
    ]);

    Route::get('submitStep11',[
        'as' => 'submitStep11',
        'uses' => 'SubmitNewProjectController@step11'
    ]);










});

