<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', [HomeController::class, 'index'])->name('home');

// group 
Route::controller(CategoryController::class)->group(function(){




Route::get("categories",'all')->name("allCategories");
Route::get("categories/show/{id}",'show')->name("showCategory");

Route::get("categories/create",'create')->name("createCategory");
Route::post("categories",'store')->name("storeCategory");

Route::get("categories/edit/{id}",'edit')->name("editCategory");
Route::put("categories/update/{id}",'update')->name("updateCategory");


Route::delete("categories/{id}" ,"delete")->name("deleteCategory");

});





Route::controller(BookController::class)->group(function(){




Route::get("Books",'all')->name("allBooks");
Route::get("Books/show/{id}",'show')->name("showBook");

Route::get("Books/create",'create')->name("createBook");
Route::post("Books",'store')->name("storeBook");

Route::get("Books/edit/{id}",'edit')->name("editBook");
Route::put("Books/update/{id}",'update')->name("updateBook");


Route::delete("Books/{id}" ,"delete")->name("deleteBook");

});

// Auth

Route::controller(AuthController::class)->group(function(){

//register
Route::get("register","registerForm")->name('registerForm');
Route::post("register","register")->name('register');

//login
Route::get("login","loginForm")->name('loginForm');
Route::post("login","login")->name('login');

//logout
Route::post("logout" , "logout")->name('logout');


});