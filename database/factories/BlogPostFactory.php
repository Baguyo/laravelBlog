<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
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
            'title'=> $this->faker->sentence(10),
            'content'=>$this->faker->paragraphs(5, true),
            'created_at'=>$this->faker->dateTimeBetween('-3 months')
        ];
    }

    public function create_for_test(){
        return $this->state(function(){
            return [
                'title' => 'Blog post new title'
            ];
        });
    }
}
