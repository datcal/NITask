<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->user_id = $request->user()->id;
        $order->product_sku = $request->sku;
        $order->save();
        Cache::forget(sprintf('%s%s',User::$USER_ORDER_CACHE_NAME,$request->user()->id));
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  string  $sku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$sku)
    {
        Order::where('product_sku', $sku)->where('user_id',$request->user()->id)->delete();
        Cache::forget(sprintf('%s%s',User::$USER_ORDER_CACHE_NAME,$request->user()->id));
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
