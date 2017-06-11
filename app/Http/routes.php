<?php

Route::get('/', function () {
    return view('app');
});

Route::post('/coba-aja',['as'=>'nyoba','uses'=>'AuthenticationController@nyoba']);

Route::group(['prefix'=>'api'],function (){
    Route::post('/registration',['as'=>'register','uses'=>'AuthenticationController@register']);
    Route::post('/user-login',['as'=>'loginPost','uses'=>'AuthenticationController@login']);
    Route::get('/user-logout',['as'=>'logout','uses'=>'AuthenticationController@logout']);
    Route::post('/user-password',['as'=>'requestResetPassword','uses'=>'AuthenticationController@requestResetPassword']);
    Route::post('/user-reset-password',['as'=>'resetPassword','uses'=>'AuthenticationController@resetPassword']);
    Route::post('/user-change-password',['as'=>'changePassword','uses'=>'AuthenticationController@changePassword']);

    Route::post('/open-jurnal',['as'=>'pagination','uses'=>'OpenJurnalController@pagination']);
    Route::post('/open-jurnal/create',['as'=>'createOpenJurnal','uses'=>'OpenJurnalController@create']);
    Route::get('/open-jurnal/{id}',['as'=>'readOpenJurnal','uses'=>'OpenJurnalController@read']);
    Route::post('/open-jurnal/update',['as'=>'updateOpenJurnal','uses'=>'OpenJurnalController@update']);
    Route::post('/open-jurnal/delete/{id}',['as'=>'deleteOpenJurnal','uses'=>'OpenJurnalController@delete']);

});
