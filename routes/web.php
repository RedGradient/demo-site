<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\SortController;


Route::get('/', [PostController::class, 'index']);


Route::resource('/posts', PostController::class);


//Route::redirect('/posts', '/');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
