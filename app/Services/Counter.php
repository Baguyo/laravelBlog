<?php 

namespace App\Services;

use App\Contracts\CounterContracts;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Session\Session;

class Counter implements CounterContracts {

    private $timeout;
    private $cache;
    private $session;
    private $supportTags;

    public function __construct( Cache $cache, Session $session, int $timeout)
    {
        $this->session = $session;
        $this->cache = $cache;
        $this->timeout = $timeout;
        $this->supportTags = method_exists($cache, "tags");
    }

    public function increment(String $key, Array $tags = null) : int {
        $sessionId = $this->session->getId();
        $counterKey = $key. "_counter";
        $userkey = $key. "_users";

        $cache = ( $this->supportTags && $tags !== null ) ? $this->cache->tags($tags) : $this->cache  ;

        $users = $cache->get($userkey, []);

        $usersUpdate = [];
        $difference = 0;
        $now = now();


        
        foreach($users as $session => $lastVisit){
            if($now->diffInMinutes($lastVisit) >= $this->timeout){
                $difference--;
            }else{
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if( !array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= $this->timeout ) {
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        $cache->forever($userkey, $usersUpdate);

        if( !$cache->has($counterKey) ){
            $cache->forever($counterKey, 1);
        }else{
           $cache->increment($counterKey, $difference);
        }

        $counter = $cache->get($counterKey);

        return $counter;
    }

}