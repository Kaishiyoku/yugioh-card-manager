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

Route::group(['middleware' => 'menus'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    /* *****************
     * Logged on users *
     ***************** */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/cards/import', 'CardController@showImportForm')->name('cards.show_import_form');
        Route::post('/cards/import', 'CardController@submitImport')->name('cards.submit_import');
        Route::resource('cards', 'CardController');
        Route::resource('sets', 'SetController')->only(['edit', 'update']);
    });
});