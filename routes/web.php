<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts');
    Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('posts.create');
    Route::get('/posts/edit/{post}', 'App\Http\Controllers\PostController@edit')->name('posts.edit');
    Route::post('/posts/update/{post}', 'App\Http\Controllers\PostController@update')->name('posts.update');
    Route::post('/posts/store', 'App\Http\Controllers\PostController@store')->name('posts.store');
    Route::post('/posts/{post}/delete', 'App\Http\Controllers\PostController@destroy')->name('posts.delete');
    Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('posts.show');
    Route::post('/posts/{post}/comment', 'App\Http\Controllers\CommentController')->name('posts.comment');
});
