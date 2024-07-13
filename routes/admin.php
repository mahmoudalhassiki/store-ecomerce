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
            Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');
            Route::get('create', 'MainCategoriesController@create')->name('admin.maincategories.create');
            Route::post('store', 'MainCategoriesController@store')->name('admin.maincategories.store');
            Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
            Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');
            Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.maincategories.delete');
            //Route::get('changeStatus/{id}','MainCategoriesController@changeStatus') -> name('admin.maincategories.status');

        });
        ##############################End Categories################################
        ##############################SubCategories################################
        Route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
            Route::get('create', 'SubCategoriesController@create')->name('admin.subcategories.create');
            Route::post('store', 'SubCategoriesController@store')->name('admin.subcategories.store');
            Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.subcategories.edit');
            Route::post('update/{id}', 'SubCategoriesController@update')->name('admin.subcategories.update');
            Route::get('delete/{id}', 'SubCategoriesController@destroy')->name('admin.subcategories.delete');
            //Route::get('changeStatus/{id}','SubCategoriesController@changeStatus') -> name('admin.subcategories.status');

        });
        ##############################End SubCategories################################
        ##############################Brands################################
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandsController@index')->name('admin.brands');
            Route::get('create', 'BrandsController@create')->name('admin.brands.create');
            Route::post('store', 'BrandsController@store')->name('admin.brands.store');
            Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
            Route::post('update/{id}', 'BrandsController@update')->name('admin.brands.update');
            Route::get('delete/{id}', 'BrandsController@destroy')->name('admin.brands.delete');
            //Route::get('changeStatus/{id}','SubCategoriesController@changeStatus') -> name('admin.subcategories.status');

        });
        ##############################End Brands################################
        ##############################Tags################################
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagsController@index')->name('admin.tags');
            Route::get('create', 'TagsController@create')->name('admin.tags.create');
            Route::post('store', 'TagsController@store')->name('admin.tags.store');
            Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
            Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
            Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
            //Route::get('changeStatus/{id}','SubCategoriesController@changeStatus') -> name('admin.subcategories.status');

        });
        ##############################End Tags################################
        ##############################Products################################
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductsController@index')->name('admin.products');
            Route::get('general-information', 'ProductsController@create')->name('admin.products.general.create');
            Route::post('store-general-information', 'ProductsController@store')->name('admin.products.general.store');
           //Route::get('edit/{id}', 'ProductsController@edit')->name('admin.products.general.edit');
            //Route::post('update/{id}', 'ProductsController@update')->name('admin.products.general.update');
            //Route::get('delete/{id}', 'ProductsController@destroy')->name('admin.products.general.delete');
            //Route::get('changeStatus/{id}','SubCategoriesController@changeStatus') -> name('admin.subcategories.status');

        });
        ##############################End Products################################
    });
    Route::group(['namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => 'guest:admin',
        'prefix' => 'admin'], function () {
        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');
    });
});
