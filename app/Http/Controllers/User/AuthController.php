<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ValidatesRequests;

    // User Registration
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ];

            $messages = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',
                'email.unique' => 'Email is already taken',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 8 characters long',
                'password.confirmed' => 'Passwords do not match',
            ];

            $this->validate($request, $rules, $messages);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // Automatically log in the user after registration
            Auth::guard('user')->login($user);

            return redirect('/user/dashboard')->with('success', 'Registration successful and logged in!');
        }

        return view('Frontend.pages.auth.register');
    }

    // User Login
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];

            $messages = [
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',
                'password.required' => 'Password is required'
            ];

            $this->validate($request, $rules, $messages);

            if (Auth:: guard('user')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('/user/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        }

        return view('Frontend.pages.auth.login');   
    }

    // User Logout
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/user/login');
    }

    // User Dashboard
    
}
