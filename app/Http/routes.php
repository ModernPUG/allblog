<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', 'ArticleController@index');
Route::get('home', 'ArticleController@index');
Route::resource('blog', 'BlogController');
Route::resource('article', 'ArticleController');
Route::get('/best/lastweek', 'ArticleController@bestLastWeek');
Route::post('/article/tag_php', 'ArticleController@tagPhp');
