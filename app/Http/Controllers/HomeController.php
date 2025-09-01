<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $books = Book::take(3)->get();
        $categories = Category::take(3)->get();

        return view('home', compact('books', 'categories'));

    }
}
