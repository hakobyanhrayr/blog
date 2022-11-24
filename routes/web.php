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




//Route::get('/', function () {
//    return view('user.blog');
//});
//
//Route::get('admin/post', function () {
//    dd(1111);
//    return view('user.post');
//})->name('post');

//Route::get('admin/home', function () {
//    return view('admin.home');
//})->name('admin');
//
//Route::get('admin/post', function () {
//    return view('admin.post.post');
//})->name('post');
//
//Route::get('admin/tag', function () {
//    return view('admin.tag.tag');
//})->name('tag');
//
//Route::get('admin/category', function () {
//    return view('admin.category.category');
//})->name('category');



//---User---
Route::resource('/',User\HomeController::class);
//
Route::group(['prefix' => 'user'],function(){
//    Route::resource('/',User\HomeController::class);
    Route::resource('/post',User\PostController::class);
});

//---Admin---

Route::group(['prefix' => 'admin'],function(){
//    ---Admin-User--routes--
    Route::resource('/user',Admin\UserController::class);
    //    ---Home--routes--
    Route::resource('/home',Admin\HomeController::class);
//    --Post--
    Route::resource('/post',Admin\PostController::class);
//    ---Tag---
    Route::resource('/tag',Admin\TagController::class);
//    ---Category--
    Route::resource('/category',Admin\CategoryController::class);
});
