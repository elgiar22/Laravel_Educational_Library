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

        $request->session()->flash('name', $data['name']);
        $request->session()->flash('email', $data['email']);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        // => login
        return view('auth.login');

        //=> website

        // Auth::login($user);
        // return redirect(url('books'));

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
        return redirect(url('index'));
       }else{
        return redirect(url('login'));
       }

    }


}
