<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login.index');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if(Auth::attempt($validated)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login Success',
                'data' => $validated['username']
            ], 200);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Login Failed',
                'data' => $validated['username']
            ], 200);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('home.index'));
    }
}
