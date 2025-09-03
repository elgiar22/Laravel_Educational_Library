<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

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

    // Password Reset Methods
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('loginForm')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

}
