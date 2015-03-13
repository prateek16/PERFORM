<?php


Route::group(['prefix' => 'officer', 'before' => array('auth')], function()
{



            Route::get('/', [
                'as' => 'officer',
                'uses' => 'OfficerController@index'
            ]);

            Route::get('programmes',[
                'as' => 'programmes',
                'uses' => 'OfficerController@programmes'
            ]);

             Route::get('projectLevel/{id}',[
                'as' => 'projectLevel',
                'uses' => 'OfficerController@projectLevel'
            ]);

              Route::get('dues',[
                'as' => 'dues',
                'uses' => 'OfficerController@dues'
            ]);

                 Route::get('dues/kpis/{id}',[
                'as' => 'dues/kpis',
                'uses' => 'OfficerController@returns'
            ]);

            Route::get('dues/submit',[
                'as' => 'dues/submit',
                'uses' => 'OfficerController@submitDue'
            ]);




});