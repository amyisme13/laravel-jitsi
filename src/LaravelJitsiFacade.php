<?php

namespace Amyisme13\LaravelJitsi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Amyisme13\LaravelJitsi\Skeleton\SkeletonClass
 */
class LaravelJitsiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-jitsi';
    }
}
