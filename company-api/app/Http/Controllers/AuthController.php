<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Incorrect']
            ]);
        }

        return $user->createToken('Auth Token')->accessToken;
    }

    public function register(RegisterRequest $request, User $user)
    {
        $currentUser = $user->create($request->all());
        Auth::login($currentUser);
    }

    public function logout(Request $request)
    {
        Auth::logout();
    }
}
