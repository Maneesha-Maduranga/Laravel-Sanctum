<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
          $user = User::where('email',$credentials['email'])->first();
          $token = $user->createToken('BlogToken')->plainTextToken;

          $response = [
            'token' => $token,
            'success' => true,
          ];
          return $response;

        }else{
            $response = [
                'sucess'=>false,
                'error' => "Invalid Credentials"
            ];
            return $response;
        }
    }

    public function logoutUser(Request $request){

        $request->user()->tokens()->delete();
        $response = [
            'sucess'=>true,
            'message'=>"LogOut User",
        ];
        return $response;
    }
}
