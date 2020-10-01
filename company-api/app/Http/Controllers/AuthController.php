<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function get(Request $request)
    {
        return json_encode($request->user());
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password], true)) {
            return response()->json(Auth::user(), 200);
        }
        return "Error";
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
