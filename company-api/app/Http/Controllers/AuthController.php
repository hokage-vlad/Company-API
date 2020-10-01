<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], true)) {
            return response()->json(Auth::user(), 200);
        }
        return "Error";
    }

    public function register(RegisterRequest $request, User $user)
    {
        $currentUser = $user->create($request->all())->where('password',md5($user->password));
        Auth::login($currentUser);
    }

    public function logout()
    {
        Auth::logout();
    }
}
