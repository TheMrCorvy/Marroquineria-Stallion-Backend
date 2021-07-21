<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'required', 'min:4', 'max:50', 'exists:users,email'],
            'password' => ['required', 'string', 'min:4', 'max:10', 'alpha']
        ]);

        try {
            $user = User::where('email', $data['email'])->firstOrFail();
        } catch (\Throwable $th) {
            return view('errors.500');
        }

        $logged_in = Auth::loginUsingId($user->id);

        if ($logged_in) {
            request()->session()->regenerate();

            return redirect()->route('home');
        }

        return view('errors.500');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }
}
