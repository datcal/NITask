<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductRepository{

    /**
     * Get whole products.
     *
     * @return array|mixed
     */
    public function listProduct(){
        $products = Cache::rememberForever(Product::PRODUCT_ALL_CACHE_NAME,function () {
            return Product::all();
        });

        if(!$products){
            return array();
        }

        return $products;
    }
}
