<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return response()->json($user, 200);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], true)) {
            return response()->json(Auth::user(), 200);
        }
        return "Error";
    }

    public function register(Request $request, User $user)
    {
        $currentUser = $user->create($request->all());
        Auth::login($currentUser);

        return response()->json($currentUser, 200);
    }

    public function logout()
    {
        Auth::logout();
    }
}
