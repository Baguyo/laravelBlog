<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();

        // DB::table('users')->insert([
        //     'name' => 'juan dela cruz',
        //     'email' => 'juandelecruz@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        
        /*
        *
        *MANUALLY DEFINE AND USE SEEDER
        *
        *
        * $default =User::factory()->defaultUser()->create();
        * $else = User::factory()->count(10)->create()
        * $users = $else->concat([$default])
        * 
        * $blogPosts = BlogPost::factory()->count(50)->make()->each(function($blogPost) use ($users) {
        * 
        *     $blogPost->user_id = $users->random()->id;
        *     $blogPost->save();
        * });

        * $comments = Comment::factory()->count(150)->make()->each(function($comment) use ($blogPosts) {
        *     $comment->blog_post_id = $blogPosts->random()->id;
        *     $comment->save();
        * });
        */



        /*
        *
        * MAKE INTERACTION WITH THE USER BEFORE DB:SEED
        *
        */

        if( $this->command->confirm("Are you sure to refresh the database?", true) ){
            $this->command->call('migrate:refresh');
            $this->command->info("Database successfully refreshed");

        }

        Cache::tags(['blog-post'])->flush();

        $this->call([
            UsersTableSeeder::class,
            BlogPostTableSeeder::class,
            CommentsTableSeeder::class,
            TagTableSeeder::class,
            BlogPostTagTableSeeder::class,
        ]);
    }
}
