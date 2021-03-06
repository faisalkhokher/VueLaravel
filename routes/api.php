<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/user' , 'API\UserController');
Route::get('/users' , 'API\UserController@data');
Route::post('/save-blog' , 'BlogController@postBlog');
Route::post('/save-post' , 'BlogController@SavingPost');
Route::get('/get-blog' , 'BlogController@getBlog');
// !POSTS
Route::get('/fetchCategories' , 'BlogController@fetchPosts');
Route::get('/posts' , 'BlogController@fetchallPosts');
Route::delete('/dlt-post/{id}' , 'BlogController@DeletePost');
Route::put('/post/UpdatePost/{id}' , 'BlogController@UpdatePost');
Route::get('/find-single/post/{id}' , 'BlogController@get_single_post_date');
Route::post('/store/category' , 'BlogController@storeCategory');
Route::post('/messages' , 'ChatController@message');