<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserOrderResource;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display data of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $this->userRepository->user($request);
        return response()->json(
            new UserResource($user)
        , Response::HTTP_OK);
    }

    /**
     * Display all orders of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function product(Request $request){
        $orders = $this->userRepository->order($request);
        return response()->json(
            UserOrderResource::collection($orders)
            , Response::HTTP_OK);
    }



}
