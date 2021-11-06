<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserOrderResource;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(
            new UserResource($request->user())
        , 200);
    }

    /**
     * Display all orders of the user
     */
    public function product(Request $request){
        return response()->json(
            UserOrderResource::collection($request->user()->orders())
            , 200);
    }



}
