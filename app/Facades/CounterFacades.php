<?php 

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CounterFacades extends Facade
{

    /**
     * @method static int increment(String $key, Array $tags = null)
     */
    public static function getFacadeAccessor(){
        return "App\Contracts\CounterContracts";
    }

}