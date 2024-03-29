<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;

class UserRepository{

    /**
     * Get user data.
     *
     * @param User $user
     * @return array|mixed
     */
    public function getUser(User $user){
        $cacheName = sprintf('%s%s', User::USER_CACHE_NAME, $user->id);

        $data = Cache::rememberForever($cacheName,function () use($user) {
            return $user;
        });

        if(!$data){
            return array();
        }

        return $data;
    }

    /**
     * Get users' orders
     *
     * @param User $user
     * @return array|mixed
     */
    public function listOrder(User $user){
        $cacheName = sprintf('%s%s', User::USER_ORDER_CACHE_NAME, $user->id);

        $orders = Cache::rememberForever($cacheName, function () use($user) {
            return $user->orders();
        });

        if(!$orders){
            return array();
        }

        return $orders;
    }

    /**
     * Create order.
     *
     * @param int $user_id
     * @param string $sku
     */
    public function createOrder(int $user_id, string $sku){
        try {
            $order = Order::create([
                'user_id' => $user_id,
                'product_sku' => $sku
            ]);
        } catch (QueryException $e) {
            return false;
        }
        $this->orderCacheForget($user_id);
        return true;
    }

    /**
     * Delete order.
     *
     * @param int $user_id
     * @param string $sku
     * @return int
     */
    public function deleteOrder(int $user_id, string $sku) : int{
        $orderStatus = Order::where('product_sku', $sku)->where('user_id', $user_id)->delete();

        if($orderStatus){
            $this->orderCacheForget($user_id);
        }

        return $orderStatus;
    }

    /**
     * Delete order cache.
     *
     * @param int $user_id
     */
    public function orderCacheForget(int $user_id){
        Cache::forget(sprintf('%s%s', User::USER_ORDER_CACHE_NAME, $user_id));
    }
}
