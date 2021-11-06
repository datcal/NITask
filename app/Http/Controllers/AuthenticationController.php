<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function auth(AuthRequest $request){
       // return $this->authRepository->login($request->email,$request->password);
        if (!Auth::attempt($request->all('email','password')))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('user_access_token');
        return response()->json([
            'token' => $tokenResult->plainTextToken,
            'token_type' => 'Bearer',
            'expires_in' => ''
        ], 200);
    }
}
