<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        
        $loginData = $request->validated();

        if(!Auth::attempt($loginData)) {
            return response(
                ['errors' => 
                    ['email' => 
                        ['El correo o la contraseña son incorrectos']
                    ]
                ], 422
            );
        }

        $user = Auth::user();
        return [
            'token' => $user->createToken('access_token')->plainTextToken,
            'user' => $user
        ];

    }
    
    public function signup(SignupRequest $request) {
        $signupData = $request->validated();

        $user = User::create([
            'name' => $signupData['name'],
            'email' => $signupData['email'],
            'password' => Hash::make($signupData['password']),            
        ]);

        return [
            'token' => $user->createToken('access_token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return [
            'user' => null
        ];
    }
}
