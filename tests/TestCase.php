<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function user(){
        return  User::factory()->create(
            
        );
    }

    protected function signIn(){
        $user = User::factory()->create()->first();
        $user->id = intval($user->id);
        $this->be($user);
        return $this;
    }
}
