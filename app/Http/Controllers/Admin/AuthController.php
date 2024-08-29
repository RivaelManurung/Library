<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Models\Book;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ValidatesRequests;
    public function login(request $request)
    {

        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            $messages = [
                'username.required' => 'Username is required',
                'password.required' => 'Password is required'
            ];

            $this->validate($request, $rules, $messages);


            if (Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password']])) {
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        }

        return view('Backend.pages.auth.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function dashboard()
    {
        // Get the count of books added per day
        $bookCountsPerDay = Book::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $latestBooks = Book::latest()->take(5)->get();

        return view('Backend.pages.dashboard', compact('bookCountsPerDay', 'latestBooks'));
    }
}
