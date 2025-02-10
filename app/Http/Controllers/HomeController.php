<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function profile()
    {
        return view('employee.profile.index');
    }

    public function edit()
    {
        return view('employee.profile.edit');
    }

    public function getFile(Request $request) {
        $fullPath = $request->get('path');

        if (Storage::disk('public')->exists($fullPath)) {
            return response()->file(storage_path("app/public/{$fullPath}"));
        }

        return response(null, 400);
    }
}
