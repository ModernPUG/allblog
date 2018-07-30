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

Route::auth();
Route::get('logout', 'Auth\LoginController@logout');


Route::get('/', 'ArticleController@index');
Route::get('home', function(){
    return redirect('/');
});
Route::resource('blog', 'BlogController');
Route::resource('article', 'ArticleController');
Route::get('/best/lastweek', 'ArticleController@bestLastWeek');
Route::post('/article/tag_php', 'ArticleController@tagPhp');
