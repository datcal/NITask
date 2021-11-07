<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CacheRepository{

    /**
     * @param $cacheName
     */
    public function forget_cache($cacheName){
        Cache::forget($cacheName);
    }
}
