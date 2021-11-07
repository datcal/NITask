<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserRepository{

    public function user(Request $request){
        $cacheName = sprintf('%s%s', User::$USER_CACHE_NAME, $request->user()->id);

        $user = Cache::rememberForever($cacheName,function () use($request) {
            return $request->user();
        });

        if(!$user){
            return array();
        }

        return $user;
    }

    public function order(Request $request){

        $cacheName = sprintf('%s%s', User::$USER_ORDER_CACHE_NAME, $request->user()->id);

        $orders = Cache::rememberForever($cacheName, function () use($request) {
            return $request->user()->orders();
        });

        if(!$orders){
            return array();
        }

        return $orders;
    }
}
