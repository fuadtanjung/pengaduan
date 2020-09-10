<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function redirect(Request $request)
    {
        if (Auth::user()) {
            return redirect()->route('login');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
