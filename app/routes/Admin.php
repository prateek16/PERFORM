<?php


Route::group(['prefix' => 'admin', 'before' => array('auth','admin')], function()
{


            Route::get('/', [
                'as' => 'admin',
                'uses' => 'AdminController@index'
            ]);

            Route::get('newProgram',[
                'as' => 'newProgram',
                'uses' => 'AdminController@newProgram'
            ]);

            Route::post('logo',[
                'as' => 'logo',
                'uses' => 'AdminController@logo'
            ]);

            Route::get('createProgram',[
                'as' => 'createProgram',
                'uses' => 'NewProgramController@createProgram'
            ]);

            Route::get('addProgramMembers',[
                'as' => 'addProgramMembers',
                'uses' => 'NewProgramController@addProgramMembers'
            ]);

            Route::get('programLevel',[
                'as' => 'programLevel',
                'uses' => 'AdminController@programLevel'
            ]);

            Route::get('addProject/{id}',[
                'as' => 'addProject',
                'uses' => 'AdminController@addProject'
            ]);

            Route::get('checkOfficer',[
                'as' => 'checkOfficer',
                'uses' => 'AdminController@checkOfficer'
            ]);

            Route::get('getCategory',[
                'as' => 'getCategory',
                'uses' => 'AdminController@getCategory'
            ]);

            Route::get('getKpis',[
                'as' => 'getKpis',
                'uses' => 'AdminController@getKpis'
            ]);


            Route::get('changePassword',[
                'as' => 'changePassword',
                'uses' => 'AdminController@changePassword'
            ]);

            Route::post('submitPassword',[
                'as' => 'submitPassword',
                'uses' => 'AdminController@submitPassword'
            ]);

            Route::get('projectLevel/{id}',[
                'as' => 'projectLevel',
                'uses' => 'AdminController@projectLevel'
            ]);

            Route::get('fundingLevel',[
                'as' => 'fundingLevel',
                'uses' => 'AdminController@fundingLevel'
            ]);

               Route::get('ene',[
                'as' => 'ene',
                'uses' => 'AdminController@ene'
            ]);






});




