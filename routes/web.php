<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'permission:manage_categories'])->group(function() {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('users/edit/{user}', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('users/update/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('users/{user}', [AdminController::class, 'destroyUser'])->name('users.delete');
});





Route::get('index', [HomeController::class, 'index'])->name('home');

// Search Route - accessible by everyone
Route::get('search', [BookController::class, 'search'])->name('search');

// Category Routes
Route::controller(CategoryController::class)->group(function(){
    // Public routes - view categories
    Route::get("categories",'all')->name("allCategories");
    Route::get("categories/show/{id}",'show')->name("showCategory");

    // Admin only routes - manage categories
    Route::middleware(['permission:manage_categories'])->group(function() {
        Route::get("categories/create",'create')->name("createCategory");
        Route::post("categories",'store')->name("storeCategory");
        Route::get("categories/edit/{id}",'edit')->name("editCategory");
        Route::put("categories/update/{id}",'update')->name("updateCategory");
        Route::delete("categories/{id}" ,"delete")->name("deleteCategory");
    });
});

// Book Routes
Route::controller(BookController::class)->group(function(){
    // Public routes - view books
    Route::get("Books",'all')->name("allBooks"); 
    Route::get("Books/show/{id}",'show')->name("showBook");

    // Authenticated user routes - read and download books
    Route::middleware(['permission:read_books'])->group(function() {
        Route::get('books/read/{book}', 'read')->name('readBook');
    });
    
    Route::middleware(['permission:download_books'])->group(function() {
        Route::get('books/download/{book}',  'download')->name('downloadBook');
    });

    // Author and Admin routes - create, edit, delete books
    Route::middleware(['permission:create_books'])->group(function(){
        Route::get("Books/create",'create')->name("createBook");
        Route::post("Books",'store')->name("storeBook");
    Route::get('Books/mybooks',  'authorBooks')->name('mybooks');

    });

    Route::middleware(['permission:edit_books'])->group(function(){
        Route::get("Books/edit/{id}",'edit')->name("editBook");
        Route::put("Books/update/{id}",'update')->name("updateBook");
    });

    Route::middleware(['permission:delete_books'])->group(function(){
        Route::delete("Books/{id}" ,"delete")->name("deleteBook");
    });


});



// Auth Routes
Route::controller(AuthController::class)->group(function(){
    //register
    Route::get("register","registerForm")->name('registerForm');
    Route::post("register","register")->name('register');

    //login
    Route::get("login","loginForm")->name('loginForm');
    Route::post("login","login")->name('login');

    //logout
    Route::post("logout" , "logout")->name('logout');

    // Password Reset Routes
    Route::get('forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('password.email');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('password.reset');
    Route::post('reset-password', 'resetPassword')->name('password.update');
});

