<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\UserOrderResource;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    /**
     * Display data of the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request){
        $user = $this->userRepository->getUser($request->user());
        return response()->json(new UserResource($user), Response::HTTP_OK);
    }

    /**
     * Display all orders of the user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listProduct(Request $request){
        $orders = $this->userRepository->listOrder($request->user());
        return response()->json(UserOrderResource::collection($orders), Response::HTTP_OK);
    }

    /**
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(OrderStoreRequest $request){
        if($this->userRepository->createOrder($request->user()->id,$request->sku)){
            return response()->json(null, Response::HTTP_CREATED);
        }
        return response()->json(array('message'=>'Wrong sku','code'=>'1000'),Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param Request $request
     * @param $sku
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOrder(Request $request, $sku){
        if($this->userRepository->deleteOrder($request->user()->id, $sku)){
            return response()->json(null, Response::HTTP_OK);
        }
        return response()->json(null, Response::HTTP_NOT_FOUND);
    }



}
