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

Route::get('test', function () {
    //return view('welcome');
    //return \App\Models\Setting::find(26);
    $category = \App\Models\Category::first();
    $category->makeVisible(['translations']);
    return $category;
});

