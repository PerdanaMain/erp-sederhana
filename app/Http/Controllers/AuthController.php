<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        try {
            request()->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('username', request('username'))->first();
            $match = Hash::check(request('password'), $user->password);

            if ($match && $user) {
                Auth::login($user);
                request()->session()->regenerate();
                return redirect()->route('purchase.index');
            }

            return back()->with('error', 'Invalid username or password');

        } catch (\Throwable $th) {
            return back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('auth.index');
    }
}
