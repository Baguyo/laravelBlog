<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if(0 === $tagCount){
            $this->command->info("Error: Assigning Blog post tag. No Tag found in the database");
            return;
        }

        $blogPostTagMin = (int)$this->command->ask('Minimum Tag for every Blog Post?', 0);
        $blogPostTagMax = min((int)$this->command->ask('Maximum Tag for every Blog Post', $tagCount), $tagCount);
        
        BlogPost::all()->each(function(BlogPost $post) use($blogPostTagMax, $blogPostTagMin) {
            $take = random_int($blogPostTagMin, $blogPostTagMax);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');

            $post->tags()->sync($tags);

        });

    }
}
