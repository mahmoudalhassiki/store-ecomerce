<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//////////////////////////////
//note that the prefix is admin for all file route
/////////////////////////////
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () { //...
    Route::group(['namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'auth:admin',
        'prefix' => 'admin'], function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        //settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping_methods/{type}', 'SettingsController@editShippingMethod')
                ->name('edit.shipping.methods');
            Route::put('shipping_methods/{id}', 'SettingsController@updateShippingMethod')
                ->name('update.shipping.methods');
        });
        //profile
        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'ProfileController@editProfile')
                ->name('edit.profile');
            Route::put('update', 'ProfileController@updateProfile')
                ->name('update.profile');
        });
        ##############################Categories################################
        Route::group(['prefix' => 'main_categories'], function () {
            Route::get('/','MainCategoriesController@index') -> name('admin.maincategories');
            Route::get('create','MainCategoriesController@create') -> name('admin.maincategories.create');
            Route::post('store','MainCategoriesController@store') -> name('admin.maincategories.store');
            Route::get('edit/{id}','MainCategoriesController@edit') -> name('admin.maincategories.edit');
            Route::post('update/{id}','MainCategoriesController@update') -> name('admin.maincategories.update');
            Route::get('delete/{id}','MainCategoriesController@destroy') -> name('admin.maincategories.delete');
          //Route::get('changeStatus/{id}','MainCategoriesController@changeStatus') -> name('admin.maincategories.status');

        });
        ##############################End Categories################################
    });
    Route::group(['namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'guest:admin',
        'prefix' => 'admin'], function () {
        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');
    });
});
