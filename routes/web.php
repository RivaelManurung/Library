<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\FavoriteController;

Route::get('/', function () {
    return view('Frontend.pages.auth.login');
});

Route::prefix('/user')->namespace('App\Http\Controllers')->group(function () {
    Route::match(['get', 'post'], 'login', 'User\AuthController@login');
    Route::match(['get', 'post'], 'register', 'User\AuthController@register');

    Route::middleware(UserMiddleware::class)->group(function () {
        Route::get('dashboard', 'User\DashboardController@dashboard');
        Route::resource('books', 'User\BookController');
        Route::resource('favorites', 'User\FavoriteController');
        Route::get('/book/search', [BookController::class, 'index'])->name('books.search');
        Route::get('/user/books/filter', [BookController::class, 'filterByCategory'])->name('books.filterByCategory');
        Route::post('/books/{book}/toggle-favorite', [FavoriteController::class, 'toggleFavorite'])->name('books.toggleFavorite');
        Route::get('/user/favorites', [FavoriteController::class, 'index'])->name('user.favorites');
        Route::get('logout', 'User\AuthController@logout');

    });
});

Route::prefix('/admin')->namespace('App\Http\Controllers')->group(function () {
    Route::match(['get', 'post'], 'login', 'Admin\AuthController@login');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('dashboard', 'Admin\AuthController@dashboard');
        Route::resource('category', 'Admin\CategoryController');
        Route::resource('book', 'Admin\BookController');
        Route::get('logout', 'Admin\AuthController@logout');
        Route::get('book-export', 'Admin\BookController@export');
        Route::get('pdf-export', 'Admin\PDFController@generatePDF');
    });
});
