<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

    public function editProfile()
    {
        return view('employee.profile.edit');
    }

    public function detail()
    {
        $hasDetail = Auth::user()->employeeDetail ?? null;
        return view('employee.detail.index', compact('hasDetail'));
    }

    public function addDetail()
    {
        return view('employee.detail.create');
    }

    public function editDetail()
    {
        return view('employee.detail.edit');
    }

    public function getFile(Request $request) {
        $fullPath = $request->get('path');

        if (Storage::disk('public')->exists($fullPath)) {
            return response()->file(storage_path("app/public/{$fullPath}"));
        }

        return response(null, 400);
    }

    public function redirectWith(Request $request): RedirectResponse
    {
        try{
            $route = $request->get('route') ?? '/';
            $type = $request->get('type') ?? 'success';
            $msg = $request->get('msg') ?? 'BERHASIL';

            if (Route::has($route)) {
                return redirect()->route($route)->with($type, $msg);
            } else {
                return back()->with('error', 'Route tidak ditemukan');
            }
        } catch(\Exception $exception){
            return back()->with('info', 'Terjadi Kesalahan');
        }
    }
}
