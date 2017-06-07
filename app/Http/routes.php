<?php

Route::get('/', function () {
    return view('auth.auth');
});
Route::group(['prefix'=>'api'],function (){
    Route::post('/registration',['as'=>'register','uses'=>'AuthenticationController@register']);
    Route::post('/user-login',['as'=>'loginPost','uses'=>'AuthenticationController@login']);
    Route::post('/user-password',['as'=>'requestResetPassword','uses'=>'AuthenticationController@requestResetPassword']);
    Route::post('/user-reset-password',['as'=>'resetPassword','uses'=>'AuthenticationController@resetPassword']);
    Route::post('/user-change-password',['as'=>'changePassword','uses'=>'AuthenticationController@changePassword']);
});
