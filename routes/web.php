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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/developer', 'DeveloperController@index');

Auth::routes();

Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
Route::post('/subscribe', 'SubsController@subscribe');
Route::get('/gallery', 'GalleryController@index');

//Для проверки залогинен ли пользователь, если да, то даем доступ к logout
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'AuthController@logout');
    Route::post('/profile', 'ProfileController@store');
    Route::get('/profile', 'ProfileController@index');
    Route::post('/comment', 'CommentsController@store');
});

//Для проверки не залогинен ли пользователь, если да, даем доступ:
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function (){
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories', 'CategoriesController'); //Вместо того чтобы создавать много роутов на создание, изменение и удаление
    Route::resource('/tags', 'TagsController');
    Route::get('/users/toggle/{id}', 'UsersController@toggleAdmin')->name('users.toggleAdmin');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
    Route::resource('/gallery', 'GalleryController');
});