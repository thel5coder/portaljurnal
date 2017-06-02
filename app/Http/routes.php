<?php

Route::get('/', function () {
    return view('auth.login');
});
Route::get('openjurnal', function (){
   return view('openjurnal.index');
});
Route::get('jurnalusulan', function (){
    return view('jurnalusulan.index');
});
Route::get('blindreview', function (){
    return view('blindreview.index');
});
Route::get('pendaftaranjurnal', function (){
   return view('pendaftaranjurnal.create');
});
Route::get('myjurnal', function (){
    return view('pendaftaranjurnal.index');
});
Route::get('revisimb', function (){
    return view('jurnalrevisi.revisimb');
});
Route::get('jurnal', function (){
    return view('jurnal.index');
});
Route::get('user', function (){
    return view('user.index');
});