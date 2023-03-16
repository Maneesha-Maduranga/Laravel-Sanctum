<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {
        $userData = $request->validate([
            'username' => 'required|unique:users|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);

        $token = $user->createToken('BlogToken')->plainTextToken;
 
        $response = [
            'token' => $token,
            'success' => true,
        ];

        return $response;
}

    public function loginUser()
    {
        return 'Login user';
    }
}
