<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('home.secret', function($user){
            return $user->is_admin;
        });

        /*
        *
        *MANUALLY DEFINE GATE
        *   
            //GATE FOR UPDATE AND EDIT         
            GATE::define('update-post', function($user, $post){
                return ( $user->id === $post->user_id );
            });

            //GATE FOR DELETE POST
            GATE::define('delete-post', function($user, $post){
                return ( $user->id === $post->user_id );
            });

            //GATE FOR DELETE POST
            GATE::define('delete-post', function($user, $post){
                return ( $user->id === $post->user_id );
            });
        */


        /*
        *
        *   MANUALLY ACCESS GATE IN THE POLICY

            // Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');
            // Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');
        *
        */
        
        

        // Gate::resource('posts', 'App\Policies\BlogPostPolicy');
        
        


        //OVERIDE THE GATE FOR SPECIAL USER LIKE ADMIN
        GATE::before(function($user, $ability){
            // if($user->is_admin){ //TO USE ABILITY ARGUEMTNS && in_array($ablility, ['delete-post', 'update-post'])
            //     return true;
            // }
        });

        //USE AFTER FOR FUTHER CHECKING
        // GATE::after(function($user, $ability, $result){
        //     if($user->is_admin){
        //         return true;
        //     }
        // });
    }
}
