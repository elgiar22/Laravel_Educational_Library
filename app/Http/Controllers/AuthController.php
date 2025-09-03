<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm(){
        return view("auth.register");
    }

    public function register(Request $request){

        // validation 

        $data = $request->validate([
        "name"=>"required|string|max:200",
        "email"=>"required|email|max:255",
        "password"=>"required|string|min:8|confirmed",
        ]);
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        // Auto login after registration
        Auth::login($user);
        
        session()->flash('success', 'Registration successful! Welcome to our library.');
        return redirect(route('home'));

    }

        public function loginForm(){
        return view("auth.login");
    }



 public function login(Request $request){

        // validation 

        $data = $request->validate([
        "email"=>"required|email|max:255",
        "password"=>"required|string",
        ]);

        $request->session()->flash('email', $data['email']);

        $valid = Auth::attempt(["email"=>$request->email,"password"=>$request->password]); //compare , login

       if($valid){
        session()->flash('success', 'Welcome back!');
        return redirect(route('home'));
       }else{
        session()->flash('error', 'Invalid credentials. Please try again.');
        return redirect(route('loginForm'));
       }

    }

    public function logout(){
        Auth::logout();
        return redirect(route('loginForm'));   
    }

    public function allUsers(){
        $users = User::all();
        dd($users);
    }

}
