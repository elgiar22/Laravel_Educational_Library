<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function registerForm(){
        return view("auth.register");
    }

    public function register(Request $request){

        // Enhanced validation with security rules
        $data = $request->validate([
        "name"=>"required|string|max:200|regex:/^[a-zA-Z\s]+$/",
        "email"=>"required|email|max:255|unique:users,email",
        "password"=>"required|string|min:8|confirmed",
        ]);
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        // Auto login after registration
        Auth::login($user);
        
        Log::info('New user registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
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
        Log::info('User logged in successfully', [
            'user_id' => Auth::id(),
            'email' => $data['email'],
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        session()->flash('success', 'Welcome back!');
        return redirect(route('home'));
       }else{
        Log::warning('Failed login attempt', [
            'email' => $data['email'],
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        session()->flash('error', 'Invalid credentials. Please try again.');
        return redirect(route('loginForm'));
       }

    }

    public function logout(){
        $user = Auth::user();

        Log::info('User logged out', [
            'user_id' => $user ? $user->id : null,
            'email' => $user ? $user->email : null,
            'ip' => request()->ip()
        ]);
        
        Auth::logout();
        return redirect(route('loginForm'));   
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

        if ($status === Password::RESET_LINK_SENT) {
            Log::info('Password reset link sent', [
                'email' => $request->email,
                'ip' => request()->ip()
            ]);
        } else {
            Log::warning('Password reset link failed', [
                'email' => $request->email,
                'ip' => request()->ip()
            ]);
        }

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
