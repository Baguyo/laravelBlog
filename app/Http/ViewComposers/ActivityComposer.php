<?php 

namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{

    public function compose(View $view){
        $mostCommented = Cache::remember('most_commented_blog_post', 60, function(){
            return BlogPost::mostCommented()->take(2)->get();
        });

        $mostWrittenBlogPost = Cache::remember('most_active_users', 60, function(){
            return User::mostBlogPostPosted()->take(3)->get();
        });

        $mostActiveAuthorLastMonth = Cache::remember('most_active_users_last_month', 60, function(){
            return User::mostBlogPostPostedLastMonth()->take(3)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostWrittenBlogPost', $mostWrittenBlogPost);
        $view->with('mostActiveAuthorLastMonth', $mostActiveAuthorLastMonth);
    }

}