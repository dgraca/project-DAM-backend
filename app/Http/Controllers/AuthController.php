<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Creates a user
     */
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
            // 'user' => [
            //     'id' => $user->id,
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'profile_pic' => $user->profile_pic,
            // ],
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Logs in a user
     */
    public function login(Request $request) {
        // validates request fields
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // check email
        $user = User::where('email', $fields['email'])->first();

        // check password
        if (!$user || !Hash::check($fields['password'] , $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        // creates the token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // returns the user and token
        $response = [
            // 'user' => [
            //     'id' => $user->id,
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'profile_pic' => $user->profile_pic,
            // ],
            'token' => $token
        ];

        return response($response, 201);
    }


    /**
     * Logs out a user
     */
    public function logout(Request $request) {
        // revokes the token
        auth()->user()->tokens()->delete();

        // returns a message
        return [
            'message' => 'Logged out'
        ];
    }
}
