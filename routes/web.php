<?php
Route::get('admin', function () {

})->name('admin');

Route::any('admin/categories/search', 'Admin\CategoryController@search')->name('categories.search');
Route::resource('admin/categories', 'Admin\CategoryController');

Route::any('admin/products/search', 'Admin\ProductController@search')->name('products.search');
Route::resource('admin/products', 'Admin\ProductController');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
