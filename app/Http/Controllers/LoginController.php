<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json(['error' => 'Invalid username'], 401);

        }

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->commonResponse([
            'user'=>$user,
            'accessToken'=>$token,
        ],'logged in',200);
    }
}
