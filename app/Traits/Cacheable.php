<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait Cacheable
{
   
    public function getFromCacheOrCalculate($key, $callback)
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $value = $callback();

        Cache::put($key, $value);

        return $value;
    }

    public function forgetCache($key)
    {
        Cache::forget($key);
    }

    public function flushCache()
    {
        $keys = ['authorsCount', 'gendersCount',
        'subgendersCount', 'publishersCount'];
        foreach($keys as $key){
            Cache::forget($key);
        }
    }
}
