<?php

Route::get('/', function () {
    return view('app');
});

Route::post('/coba-aja',['as'=>'nyoba','uses'=>'JurnalController@pagination']);

Route::group(['prefix'=>'api'],function (){
    Route::post('/registration',['as'=>'register','uses'=>'AuthenticationController@register']);
    Route::post('/user-login',['as'=>'loginPost','uses'=>'AuthenticationController@login']);
    Route::get('/user-logout',['as'=>'logout','uses'=>'AuthenticationController@logout']);
    Route::post('/user-password',['as'=>'requestResetPassword','uses'=>'AuthenticationController@requestResetPassword']);
    Route::post('/user-reset-password',['as'=>'resetPassword','uses'=>'AuthenticationController@resetPassword']);
    Route::post('/user-change-password',['as'=>'changePassword','uses'=>'AuthenticationController@changePassword']);

    Route::post('/kategori','KategoriController@pagination');
    Route::post('/kategori/create','KategoriController@create');
    Route::get('/kategori/read/{id}','KategoriController@read');
    Route::get('/kategori/all','KategoriController@showAll');
    Route::post('/kategori/update','KategoriController@update');
    Route::post('/kategori/delete/{id}','KategoriController@delete');

    Route::post('/open-jurnal',['as'=>'openJurnalPagination','uses'=>'OpenJurnalController@pagination']);
    Route::post('/open-jurnal/create',['as'=>'createOpenJurnal','uses'=>'OpenJurnalController@create']);
    Route::get('/open-jurnal/read/{id}',['as'=>'readOpenJurnal','uses'=>'OpenJurnalController@read']);
    Route::post('/open-jurnal/update',['as'=>'updateOpenJurnal','uses'=>'OpenJurnalController@update']);
    Route::post('/open-jurnal/delete/{id}',['as'=>'deleteOpenJurnal','uses'=>'OpenJurnalController@delete']);
    Route::get('/open-jurnal/get-default',['as'=>'openJurnalGetDefault','uses'=>'OpenJurnalController@getDefault']);
    Route::get('/open-jurnal/all','OpenJurnalController@showAll');

    Route::post('/jurnal',['as'=>'jurnalPagination','uses'=>'JurnalController@pagination']);
    Route::post('/jurnal/create',['as'=>'createJurnal','uses'=>'JurnalController@create']);
    Route::get('/jurnal/read/{id}',['as'=>'readJurnal','uses'=>'JurnalController@read']);
    Route::get('/penulis-jurnal/read/{id}',['as'=>'penulisJurnal','uses'=>'JurnalController@readPenulisJurnal']);
    Route::post('/jurnal/update',['as'=>'updateJurnal','uses'=>'JurnalController@update']);
    Route::post('/jurnal/delete/{id}',['as'=>'deleteJurnal','uses'=>'JurnalController@delete']);
//    Route::post('/jurnal/changestatus/{status}/{id}',['as'=>'changeStatusJurnal','uses'=>'JurnalController@changeStatus']);
//    Route::post('/jurnal/changetahap/{tahap}/{id}',['as'=>'changeTahapJurnal','uses'=>'JurnalController@changeTahap']);
    Route::post('/jurnal-usulan',['as'=>'paginationJurnalUsulan','uses'=>'JurnalController@paginationJurnalUsulan']);

    Route::post('/blind-review/create',['as'=>'createBlindReview','uses'=>'BlindReviewController@post']);
    Route::post('/blind-review',['as'=>'blindReviewPagination','uses'=>'BlindReviewController@pagination']);
    Route::get('/blind-review/download/{id}',['as'=>'downloadBlindReview','uses'=>'BlindReviewController@download']);
});
