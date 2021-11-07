<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserRepository{

    /**
     * @param User $user
     * @return array|mixed
     */
    public function get_user(User $user){
        $cacheName = sprintf('%s%s', User::$USER_CACHE_NAME, $user->id);

        $data = Cache::rememberForever($cacheName,function () use($user) {
            return $user;
        });

        if(!$data){
            return array();
        }

        return $data;
    }

    /**
     * @param User $user
     * @return array|mixed
     */
    public function list_order(User $user){

        $cacheName = sprintf('%s%s', User::$USER_ORDER_CACHE_NAME, $user->id);

        $orders = Cache::rememberForever($cacheName, function () use($user) {
            return $user->orders();
        });

        if(!$orders){
            return array();
        }

        return $orders;
    }

    /**
     * @param int $user_id
     * @param string $sku
     */
    public function create_order(int $user_id, string $sku) : void{
        Order::create([
            'user_id' => $user_id,
            'product_sku' =>$sku
        ]);
    }

    /**
     * @param int $user_id
     * @param string $sku
     * @return int
     */
    public function delete_order(int $user_id, string $sku) : int{
        return Order::where('product_sku', $sku)->where('user_id', $user_id)->delete();
    }
}
