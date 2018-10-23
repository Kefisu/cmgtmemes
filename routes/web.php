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
// Compress images that are uploaded via the website
Route::middleware('optimizeImages')->group(function () {
    // Index route
    Route::get('/', 'PagesController@index')->name('homepage');

    // Auth routes
    Auth::routes(['verify' => true]);
    // Post routes
    Route::get('/post/{slug}', 'PostsController@show')->name('showPost');
    Route::get('/upload', 'PostsController@create')->name('upload')->middleware('verified');
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
    Route::get('/user/account', 'UserDashboardController@account')->name('userAccount');

    // Admin dashboard routes
    Route::get('/admin', 'AdminDashboardController@index')->name('adminDashboard');
    Route::get('/admin/account', 'AdminDashboardController@account')->name('adminAccount');
    Route::get('/admin/analytics', 'AdminDashboardController@analytics')->name('analytics');

    Route::get('/search', 'SearchController@index');
    Route::post('/search', 'SearchController@index');
});
