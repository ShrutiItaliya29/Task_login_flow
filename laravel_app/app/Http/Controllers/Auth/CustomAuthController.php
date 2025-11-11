<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerRegisterRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Http\Requests\AdminLoginRequest;


class CustomAuthController extends Controller
{
    // Customer Registration
    public function showCustomerRegisterForm() {
        return view('auth.register-customer');
    }

    public function registerCustomer(CustomerRegisterRequest  $request) {
        $verification_code = rand(100000, 999999);

        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'customer',
            'verification_code'=>$verification_code,
        ]);

        Mail::raw("Your verification code is: $verification_code", function($message) use ($user){
            $message->to($user->email)->subject('Email Verification Code');
        });

         // Flash success message
        return redirect()->route('verify.email')
                    ->with('success', 'Registered successfully! Please check your email for verification code.');
    }

    // Admin Registration
    public function showAdminRegisterForm() {
        return view('auth.register-admin');
    }

    public function registerAdmin(AdminRegisterRequest  $request) {
        $verification_code = rand(100000, 999999);

        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'admin',
            'verification_code'=>$verification_code,
        ]);

        Mail::raw("Your verification code is: $verification_code", function($message) use ($user){
            $message->to($user->email)->subject('Email Verification Code');
        });

         // Flash success message
        return redirect()->route('verify.email')
                        ->with('success', 'Registered successfully! Please check your email for verification code.');
    }

    // Email Verification
    public function showVerificationForm() {
        return view('auth.verify-email');
    }

    public function verifyEmail(VerifyEmailRequest  $request) {
        $user = User::where('email',$request->email)
                    ->where('verification_code',$request->verification_code)
                    ->first();

        if(!$user){
            return back()->withErrors(['verification_code'=>'Invalid verification code']);
        }

        $user->is_verified = true;
        $user->verification_code = null;
        $user->save();

        return redirect('/admin/login')->with('success','Email verified successfully');
    }

    // Admin Login
    public function showAdminLoginForm() {
        return view('auth.admin-login');
    }

    public function adminLogin(AdminLoginRequest  $request) {
        $user = User::where('email',$request->email)->first();

        if(!$user){
            return back()->withErrors(['email'=>'Invalid credentials']);
        }

        if($user->role != 'admin'){
            return back()->withErrors(['email'=>'You are not allowed to login from here']);
        }

        if(!$user->is_verified){
            return back()->withErrors(['email'=>'Your email is not verified']);
        }

        if(!Hash::check($request->password, $user->password)){
            return back()->withErrors(['email'=>'Invalid credentials']);
        }

        Auth::login($user);

        return redirect('/admin/dashboard');
    }
}
