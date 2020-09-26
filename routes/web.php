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


Route::get('/','PublicController@index')->name ('index');
Route::get('post/{id}','PublicController@singlePost')->name ('singlePost')->where('id', '[0-9]+');;
Route::get('/post','PublicController@post')->name ('post');
Route::get('/about','PublicController@about')->name ('about');
Route::get('/contact','PublicController@contact')->name ('contact');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');




Route::prefix('user')->group(function (){
    Route::post('/newComment', 'UserController@newComment')->name('newComment');
    Route::get('/dashboard', 'UserController@dashboard')->name('userDashboard');
    Route::get('/comments', 'UserController@comments')->name('userComments');
    Route::post('/comments/{id}/delete', 'UserController@deleteComment')->name('deleteComment');
    Route::get('/profile', 'UserController@profile')->name('userProfile');
    Route::post('/profile', 'UserController@profilePost')->name('userProfilePost');
});



Route::prefix('author')->group(function (){
    Route::get('/dashboard', 'AuthorController@dashboard')->name('authorDashboard');
    Route::get('/posts', 'AuthorController@posts')->name('authorPosts');
    Route::get('posts/new', 'AuthorController@newPost')->name('newPost');
    Route::post('post/new', 'AuthorController@createPost')->name('createPost');
    Route::get('post/{id}/edit', 'AuthorController@postEdit')->name('postEdit');
    Route::post('post/{id}/edit', 'AuthorController@postEditPost')->name('postEditPost');
    Route::post('post/{id}/delete', 'AuthorController@postDelete')->name('postDelete');
    Route::get('/comments', 'AuthorController@comments')->name('authorComments');
});




Route::prefix('admin')->group (function (){
    Route::get('/dashboard', 'AdminController@dashboard')->name('adminDashboard');
    Route::get('/posts', 'AdminController@posts')->name('adminPosts');
    Route::get('/comments', 'AdminController@comments')->name('adminComments');
    Route::get('post/{id}/edit', 'AdminController@postEdit')->name('adminpostEdit');
    Route::post('post/{id}/edit', 'AdminController@postEditPost')->name('adminpostEditPost');
    Route::post('post/{id}/delete', 'AdminController@postDelete')->name('adminpostDelete');
    Route::post('/comment/{id}/delete', 'AdminController@deleteComment')->name('admindeleteComment');
    Route::get('/users', 'AdminController@users')->name('adminUsers');
    Route::get('user/{id}/edit', 'AdminController@editUser')->name('adminEditUser');
    Route::post('user/{id}/edit', 'AdminController@editUserPost')->name('adminEditUserPost');
    Route::post('user/{id}/delete', 'AdminController@deleteUser')->name('adminDeleteUser');

    Route::get('products', 'AdminController@products')->name('adminProducts');
    Route::get('products/new', 'AdminController@newProduct')->name('adminNewProduct');
    Route::post('products/new', 'AdminController@newProductPost')->name('adminNewProduct');
    Route::get('product/{id}', 'AdminController@editProduct')->name('adminEditProduct');
    Route::post('product/{product}', 'AdminController@editProductPost')->name('adminEditProduct');
});

Route::prefix('shop')->group(function (){
    Route::get('/', 'ShopController@index')->name('shop.index');
    Route::get('product/{id}', 'ShopController@singleProduct')->name('shop.singleProduct');
    Route::get('product/{id}/order', 'ShopController@orderProduct')->name('shop.orderProduct');
    Route::get('product/{id}/execute', 'ShopController@executeOrder')->name('shop.executeOrder');
});
