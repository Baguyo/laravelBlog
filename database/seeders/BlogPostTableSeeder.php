<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $blogPostCount = (int)$this->command->ask('How many Blog post you would like to create?', 50);

        $users = User::all();

        BlogPost::factory()->count($blogPostCount)->make()->each(function($blogPost) use ($users) {
            
            $blogPost->user_id = $users->random()->id;
            $blogPost->save();
        });
    }
}
