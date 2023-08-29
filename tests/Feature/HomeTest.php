<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page_working_correctly()
    {
        $response = $this->get('/');

        $response->assertSeeText("Home page");
    }

    public function test_contact_page_working_correctly(){
        $response = $this->get('/contact');

        $response->assertSeeText('Contact page');
    }
}
