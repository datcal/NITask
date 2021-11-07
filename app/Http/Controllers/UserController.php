<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\UserOrderResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_user(Request $request)
    {
        $user = $this->userRepository->get_user($request->user());
        return response()->json(new UserResource($user), Response::HTTP_OK);
    }

    /**
     * Display all orders of the user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list_product(Request $request){
        $orders = $this->userRepository->list_order($request->user());
        return response()->json(UserOrderResource::collection($orders), Response::HTTP_OK);
    }

    /**
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add_order(OrderStoreRequest $request){
        $this->userRepository->create_order($request->user()->id,$request->sku);
        Cache::forget(sprintf('%s%s', User::$USER_ORDER_CACHE_NAME, $request->user()->id));
        return response()->json(null, Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param $sku
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_order(Request $request, $sku){
        if($this->userRepository->delete_order($request->user()->id, $sku)){
            Cache::forget(sprintf('%s%s', User::$USER_ORDER_CACHE_NAME, $request->user()->id));
            return response()->json(null, Response::HTTP_OK);
        }

        return response()->json(null, Response::HTTP_NOT_FOUND);
    }



}
