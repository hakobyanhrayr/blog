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
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\User\ContentController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Auth;


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/',User\HomeController::class);


Route::resource('/like',User\LikeController::class);

//
Route::group(['prefix' => 'user'],function(){
    Route::resource('/posted',User\UserPostController::class);
    Route::get('/category',[ContentController::class,'category'])->name('category');
    Route::get('/tag',[ContentController::class,'tag'])->name('tag');
});

//    Route::resource('/post',[PostController::class]);

//    ---Admin Auth--
Route::get('admin-login', [LoginController::class,'showLoginForm']);

Route::post('admin-login', [LoginController::class,'login'])->name('admin.login');

//---Admin---

Route::group(['prefix' => 'admin','middleware'=>'auth:admin'],function(){

//    ---Admin-User--routes--
    Route::resource('/user',Admin\UserController::class);

    //    ---Admin-User--Roles--routes--
    Route::resource('/role',Admin\RoleController::class);

    //    ---Admin-User--Roles--routes--
    Route::resource('/permission',Admin\PermissionController::class);

    //    ---Home--routes--
    Route::resource('/home',Admin\HomeController::class);

//    --Post--
    Route::resource('/post',Admin\PostController::class);

//    ---Tag---
    Route::resource('/tag',Admin\TagController::class);

//    ---Category--
    Route::resource('/category',Admin\CategoryController::class);
});

Auth::routes();

