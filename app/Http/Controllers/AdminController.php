<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function dashboard() {
        $users = User::all();
        $books = Book::all();
        $categories = Category::all();

        return view('admin.dashboard', compact('users', 'books','categories'));
    }

    public function editUser(User $user) {
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:user,author,admin'
        ]);
        $user->update($request->all());
        return redirect()->route('dashboard')->with('success', 'User updated!');
    }

    public function destroyUser(User $user) {
        $user->delete();
        return back()->with('success', 'User deleted!');
    }
}
