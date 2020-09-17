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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::get('/config', 'UserController@config')->name('user.config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{fileName}', 'UserController@getImage')->name('user.avatar');

Route::get('/createPost', 'PostController@create')->name('post.create');
Route::post('/post/save', 'PostController@save')->name('post.save');
Route::get('/post/image/{fileName}', 'PostController@getImage')->name('post.image');

Route::get('/post/{id}', 'PostController@postdetail')->name('post.postdetail');