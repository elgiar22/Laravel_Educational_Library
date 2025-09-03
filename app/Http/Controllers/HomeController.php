<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $books = Book::take(3)->get();
        $categories = Category::withCount('books')->take(3)->get();
        $users =User::all();
            $authorCount = $users->where('role', 'author')->count();

        return view('home', compact('books', 'categories' , 'authorCount'));

    }
}
