<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) return $this->validationFail($validator);

            if (!Auth::attempt($request->only('email', 'password'))) {
                return back()->with('error', 'Email atau kata sandi salah');
            }
            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;
            return view('token.save', compact('token'));

        } catch(\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    public function logout(Request $request)
    {
        return view('token.delete');
    }

    public function removeToken(Request $request){
        $request->user()->currentAccessToken()->delete();
    }
}
