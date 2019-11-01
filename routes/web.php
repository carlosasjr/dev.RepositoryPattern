<?php
Route::resource('admin/categories', 'Admin\CategoryController');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
