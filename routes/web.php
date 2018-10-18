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
// Index route
Route::get('/', 'PagesController@index')->name('homepage');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

// Post routes
Route::get('/post/{slug}', 'PostsController@show')->name('showPost');
Route::get('/upload', 'PostsController@create')->name('upload');
Route::resource('posts', 'PostsController');
Route::put('/post/featured/{post}', 'PostsController@featured');

// Tag routes
Route::get('/tag/{slug}', 'TagsController@show');
Route::get('/tags/get', 'TagsController@get');
