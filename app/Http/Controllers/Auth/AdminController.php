<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ],
        [
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ],400);
        } else {
            $input = [
                'email' => $request->email,
                'password' => $request->password,
                'is_admin' => true
            ];
            if(Auth::attempt($input)) {
                $request->session()->regenerate();
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Berhasil'
                ]);
            } else {
                return response()->json([
                    'status' => 422,
                    'message' => 'Email atau password tidak valid!'
                ], 422);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('sign-in.admin');
    }
}
