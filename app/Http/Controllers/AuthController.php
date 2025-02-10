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
            if ($validator->fails()) return back()->withErrors($validator->errors());

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

    public function issueToken(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) return $this->validationFail($validator);

            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->returnJson(
                ['user' => $user, 'access_token' => $token],
                200,
                'Login Berhasil!'
            );
        } catch(\Exception $exception){
            return $this->returnJson(
                code: 500,
                message: 'Login Gagal! ' . $exception->getMessage()
            );
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo' => 'nullable'
        ]);
        if ($validator->fails()) return back()->withErrors($validator->errors());

        $data = $request->all();
        if ($request->hasFile('photo')){
            $path = $this->processFileName($request->photo);
            $data['photo_path'] = $path;
        }


        $user = User::create($data);

        Auth::loginUsingId($user->id);

        $token = $user->createToken('auth_token')->plainTextToken;
        return view('token.save', compact('token'));
        try{


        } catch(\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return view('token.delete');
    }

    public function removeToken(Request $request){
        $request->user()->currentAccessToken()->delete();
    }
}
