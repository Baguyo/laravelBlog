<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Profile;
use App\Models\Profle;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Author $author, $faker){
            $author->profile()->save(Profile::factory()->make());
        });
    }
}
