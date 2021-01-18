<?php

namespace App\Http\Middleware;
use Closure;

class CacheRemover
{
    public function handle($request, Closure $next) {
        $path = app('path.storage').'/framework/views/';
        $cachedViewsDirectory = new \DirectoryIterator($path);
        foreach ($cachedViewsDirectory as $entry) {
            if (!$entry->isDot()) {
                @unlink($path.$entry->getFilename());
            }
        }
        return $next($request);
    }
}