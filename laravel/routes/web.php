<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    $posts = auth()->check()
        ? auth()->user()->posts()->get()
        : collect();

    return view('home', compact('posts'));
});


Route::post('/register',[UserController::class,'register']);
Route::post('/logout',[UserController::class,'logout']);
Route::post('/login',[UserController::class,'login']);
Route::post('/create-post', [PostController::class, 'createPost'])->middleware('auth');
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->middleware('auth');
Route::put('/edit-post/{post}', [PostController::class, 'editPost'])->middleware('auth');


