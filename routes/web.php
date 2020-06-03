<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'foreign-transactions'], function () {
    Route::get('', 'Cms\ForeignTransactionController@index')->name('cms.foreign-transactions.index');
    Route::get('create', 'Cms\ForeignTransactionController@create')->name('cms.foreign-transactions.create');
    Route::post('store', 'Cms\ForeignTransactionController@store')->name('cms.foreign-transactions.store');
});
