<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authors
Route::resource('authors', Controllers\AuthorController::class)->except(['show']);

// Books
Route::resource('books', Controllers\BookController::class);


