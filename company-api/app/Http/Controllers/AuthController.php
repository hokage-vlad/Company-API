<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !$request->password) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        return $user->createToken('Auth Token')->accessToken;
    }

    public function register(RegisterRequest $request, User $user)
    {
        $currentUser = $user->create($request->all());
        Auth::login($currentUser);
    }

    public function logout()
    {
        Auth::logout();
    }
}
