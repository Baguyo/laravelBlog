<?php 

namespace App\Contracts;

interface CounterContracts{

    public function increment(String $key, Array $tags = null) : int;
    
}