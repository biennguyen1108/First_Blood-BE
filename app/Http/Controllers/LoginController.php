<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    public function login(LoginRequest $loginrequest)
    {
        $user = User::where('email', $loginrequest->email)->first();

        if(!$user || !Hash::check($loginrequest->password,$user->password)){
            return $this->commonResponse([],"Invalid username",404);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->commonResponse([
            'accessToken'=>$token,
        ],'logged in',200);
    }
}
