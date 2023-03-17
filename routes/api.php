<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/auth/register', [UserController::class,'registerUser']);
Route::post('/auth/login', [UserController::class,'loginUser']);
Route::middleware('auth:sanctum')->post('/auth/logout', [UserController::class,'logoutUser']);

//Blog Routes
Route::middleware('auth:sanctum')->post('/blogs', [BlogController::class,'createBlog']);
Route::get('/blogs', [BlogController::class,'getAllBlogs']);
Route::get('/blogs/{blog}', [BlogController::class,'getSingleBlog']);
Route::middleware('auth:sanctum','can:delete,blog')->delete('/blogs/{blog}', [BlogController::class,'deleteBlog']);
Route::middleware('auth:sanctum','can:update,blog')->put('/blogs/{blog}', [BlogController::class,'updateBlog']);
