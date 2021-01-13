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

    Route::get('/', 'MainController@index');
    Route::get('/articles', 'MainController@showList')->name('articles');
    Route::get('/articles/{id}', 'MainController@show');
    Route::post('/comment', 'MainController@addComment');
    Route::post('/like', 'MainController@likeArticle');
    Route::post('/view', 'MainController@viewArticle');
    Route::get('/tag/{id}', 'MainController@tagArticles');