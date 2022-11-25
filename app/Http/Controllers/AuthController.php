<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // register
    public function register(Request $request) {
        // validates request fields
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        // creates the user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // creates the token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // returns the user and token
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
