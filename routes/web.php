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

//Ruta página principal
Route::get('/index', 'HomeController@index')->name('home');
Route::get('/', 'PostController@index')->name('mymainpage');

//Rutas de Usuarios
Route::get('/config', 'UserController@config')->name('user.config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{fileName}', 'UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/user/showUsers/{search?}', 'UserController@showUsers')->name('user.showUsers');
Route::get('/user/showFollowers/{id}', 'UserController@showFollowers')->name('user.showFollowers');
Route::get('/user/showFollowing/{id}', 'UserController@showFollowing')->name('user.showFollowing');

//Rutas de Seguidores
Route::get('/follow/{user_id}', 'FollowerController@follow')->name('follow.save');
Route::get('/unfollow/{user_id}', 'FollowerController@unfollow')->name('unfollow.delete');

//Rutas de publicaciones
Route::get('/createPost', 'PostController@create')->name('post.create');
Route::post('/post/save', 'PostController@save')->name('post.save');
Route::get('/post/image/{fileName}', 'PostController@getImage')->name('post.image');
Route::get('/post/delete/{id}', 'PostController@delete')->name('post.delete');
Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::get('/post/{id}', 'PostController@postdetail')->name('post.postdetail');
Route::post('/post/update', 'PostController@update')->name('post.update');

//Rutas de Comentarios
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//Rutas de Likes
Route::get('/like/{post_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{post_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/userLikes', 'LikeController@userLikes')->name('userLikes');
Route::get('/whoLikes/{post_id}', 'LikeController@whoLikes')->name('whoLikes');
