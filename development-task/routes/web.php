<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use \Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('countries/datatable', 'CountriesController@datatableList')->name('countries.datatable');
    Route::resource('countries', 'CountriesController');

    Route::get('states/datatable', 'StatesController@datatableList')->name('states.datatable');
    Route::resource('states', 'StatesController');

    Route::get('counties/datatable', 'CountiesController@datatableList')->name('counties.datatable');
    Route::resource('counties', 'CountiesController');

    Route::get('taxrates/datatable', 'TaxratesController@datatableList')->name('taxrates.datatable');
    Route::resource('taxrates', 'TaxratesController');

    Route::get('taxes/datatable', 'TaxesController@datatableList')->name('taxes.datatable');
    Route::get('taxes/data', 'DataController@importExportView')->name('taxes.data');
    Route::get('taxes/data/export', 'DataController@export')->name('taxes.data.export');
    Route::post('taxes/data/import', 'DataController@import')->name('taxes.data.import');

    Route::resource('taxes', 'TaxesController');
});
