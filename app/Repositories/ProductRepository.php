<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository{

    public function all(){
        $products = Cache::rememberForever(Product::$PRODUCT_ALL_CACHE_NAME,function () {
            return Product::all();
        });

        if(!$products){
            return array('');
        }

        return $products;
    }
}
