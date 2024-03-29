<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {

    //Route::get('reports/months', 'ReportsController@months')->name('reports.name');
    Route::get('reports/months', 'ReportsController@months2')->name('reports.months');
    Route::get('reports/years', 'ReportsController@year')->name('reports.years');

    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');

});


Route::get('teste', function() {

    dd(opcache_get_configuration());
});

Auth::routes(['register' => true]);
Route::get('/', 'SiteController@index')->name('admin');




