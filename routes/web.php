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

// Auth routes
Auth::routes(['verify' => true]);

// Post routes
Route::get('/post/{slug}', 'PostsController@show')->name('showPost');
Route::get('/upload', 'PostsController@create')->name('upload')->middleware('verified');;
Route::resource('posts', 'PostsController');
Route::put('/post/featured/{post}', 'PostsController@featured');

// Tag routes
Route::get('/tag/{slug}', 'TagsController@show');
Route::get('/tags/get', 'TagsController@get');
Route::get('/tag/add/{slug}', 'TagsController@store')->middleware('verified');;

// Dashboard redirect route
Route::get('/dashboard', 'DashboardController');

// User dashboard routes
Route::get('/user', 'UserDashboardController@index')->name('userDashboard');

// Admin dashboard routes
Route::get('/admin', 'AdminDashboardController@index')->name('adminDashboard');

Route::get('send_test_email', function () {
   Mail::raw('Sending emails with mailgun and Laravel is easy!', function ($message) {
       $message->subject('Mailgun and Laravel are awsome!');
       $message->to('kevitius99@gmail.com');
       $message->from('noreply@sp.cmgtmemes.nl');
   }) ;
});

Route::get('/search', 'SearchController@index');
Route::post('/search', 'SearchController@index');
