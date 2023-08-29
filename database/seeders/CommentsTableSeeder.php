<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $blogPosts = BlogPost::all();
        $users = User::all();

        if($blogPosts->count() === 0 || $users->count() === 0){
            $this->command->info('No Blog post or User in the database, comments will not be generated. ');
            return;
        }

        $commentCount = (int)$this->command->ask("How many comments you would like to create?", 150);

        

        Comment::factory()->count($commentCount)->make()->each(function($comment) use ($blogPosts, $users) {
            $comment->commentable_id = $blogPosts->random()->id;
            $comment->commentable_type = 'App\Models\BlogPost';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

        Comment::factory()->count($commentCount)->make()->each(function($comment) use ($users) {
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = 'App\Models\User';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
