<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class AuthenticationController extends Controller
{
    public function auth(AuthRequest $request){
        if (!Auth::attempt($request->all('email','password'))){
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $tokenResult = $request->user()->createToken('user_access_token');
        return response()->json([
            'token' => $tokenResult->plainTextToken,
            'token_type' => 'Bearer'
        ], Response::HTTP_OK);
    }
}
