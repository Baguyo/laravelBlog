<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\Comment;
use Faker\Factory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PostTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_no_blog_post_available()
    {
        // dd(env('APP_URL', '?'));

        
        // $this->actingAs(Auth::user());
        $response = $this->get('/posts');
        $response->assertSeeText('No post available');
    }

    public function test_one_blog_post_posted_no_comment(){
        $blogPost = $this->create_dummy_blog_post();
        
        

        $response = $this->get('/posts');
        $response->assertStatus(200);
        // $response->assertSeeText('Blog post new title');
        // $response->assertSeeText('No comment');

        // $this->assertDatabaseHas('blog_posts', [
        //     'title' => 'Blog post new title',
            
        // ]);

        
    }

    public function test_one_blog_post_posted_with_comment(){
        $user = $this->user();
        $blogPost = $this->create_dummy_blog_post($user->id);
        Comment::factory()->count(4)->create(
            [
                'commentable_id'=>$blogPost->id,
                'commentable_type' => 'App\Models\BlogPost',
                'user_id' => $user->id

                ]
        );

        $response = $this->get('/posts');

        $response->assertSeeText('Blog post new title');
        $response->assertSeeText('4 Comments');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Blog post new title',
        ]);

        
    }

    public function test_blog_post_creation(){

        

        $params = [
            'title' => 'Blog post new title',
            'content' => 'Blog post new content'
        ];

        $user = $this->user();

        $this->actingAs($user)
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        
        $this->assertEquals(session('status'), 'Blog post was created');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Blog post new title',
            
        ]);
    }

    public function test_blog_post_creation_error(){

        $user = $this->user();

        $params = [
            'title' => 'x',
            'content' => 'x'
        ];
        

        $this->actingAs($user)
        ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    
    public function test_blog_post_update_post(){

        $user = User::factory()->create();
        
        $blogPost = $this->create_dummy_blog_post($user->id);

        $this->assertDatabaseHas('blog_posts', [
            'title'=>'Blog post new title',
            
        ]);

        $params = [
            'title' => 'new Blog post new title',
            'content' => 'new Blog post new content'
        ];


        

        $this->actingAs($user)
        ->put("/posts/{$blogPost->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), "Blog post was updated");
        $this->assertDatabaseMissing('blog_posts', [
            'title'=>'Blog post new title',
            
        ]);

    }

    public function test_delete_blog_post(){


        $user = User::factory()->create()->first();

        

        $blogPost = $this->create_dummy_blog_post($user->id);

        $this->actingAs($user)
        ->delete("/posts/{$blogPost->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
        
        $this->assertEquals(session('status'), "Blog post was deleted");
        // $this->assertDatabaseMissing('blog_posts', [
        //     'title'=>'Blog post new title',
        // ]);

        $this->assertSoftDeleted('blog_posts', ['title'=>'Blog post new title']);
    }

    private function create_dummy_blog_post($userId = null){
        // $blogPost = new BlogPost();
        // $blogPost->title = 'Blog post new title';
        // $blogPost->content = 'Blog post new content';
        // $blogPost->save();
        // return $blogPost;
        return BlogPost::factory()->create_for_test()->create([
            'user_id' => $userId ?? $this->user()->id,
        ]);
    }

}
