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

Route::get('/', 'HomeController@home')->name("home");
                                    // ->middleware('auth')
                                    

Route::get('/contact', 'HomeController@contact')->name('contact');


Route::get('/secret', 'HomeController@secretPage')->name('secret')->middleware('can:home.secret');

// Route::get('/blog-post/{id}/{welcome?}');
Route::resource('/posts', 'PostController');


Route::get("/posts/tag/{tag}", 'PostTagController@index')->name('posts.tag.index');

Route::resource('/post.comment', 'PostCommentController')->only([ 'index', 'store']);

Route::resource('users.comment', 'UserCommentController')->only('store');


Route::resource('users', 'UserController')->only(['show', 'edit', 'update']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
