<?php

namespace App\Providers;

use App\Http\Resources\Comment as ResourcesComment;
use App\Http\ViewComposers\ActivityComposer;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use App\Services\Counter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Schema::defaultStringLength(191);

        Blade::aliasComponent('components.badge', 'badge');
        Blade::aliasComponent('components.updated', 'updated');
        Blade::aliasComponent('components.card', 'card');
        Blade::aliasComponent('components.tags', 'tag');
        Blade::aliasComponent('components.errors', 'errors');
        Blade::aliasComponent('components.comments-form', 'commentForm');
        Blade::aliasComponent('components.comments-list', 'commentList');
     
        view()->composer( ['posts.index', 'posts.show'], ActivityComposer::class);

        BlogPost::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);

        // $this->app->bind(Counter::class, function($app){
        //     return new Counter(random_int(0,100));
        // });

        $this->app->singleton(Counter::class, function($app){
                return new Counter(
                    $app->make("Illuminate\Contracts\Cache\Factory"),
                    $app->make("Illuminate\Contracts\Session\Session"),
                    env('Counter_timeout')
                );
        });

        $this->app->bind(
            'App\Contracts\CounterContracts',
            Counter::class
        );

        // ResourcesComment::withoutWrapping();

    }
}
