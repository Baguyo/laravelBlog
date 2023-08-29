<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Cache\Events\CacheHit;
use Illuminate\Support\Facades\Log;

class CacheSubscriber
{
    

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleCacheHit($event)
    {
        Log::info( " {$event->key} cache hit" );
    }

    public function handleCachedMissed($event){
        Log::info( " {$event->key} cache missed" );
    }

    public function subscribe($event){

        $event->listen(
            CacheHit::class,
            'App\Listeners\CacheSubscriber@handleCacheHit'
        );

        $event->listen(
            CacheMissed::class,
            'App\Listeners\CacheSubscriber@handleCachedMissed',
        );


    }
}
