<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;

class PostTagController extends Controller
{

    

    public function index($tagId){

        $tag = Tag::findOrFail($tagId);

        return view('posts.index', [
            'posts' => $tag->blogPost()->lastestWithRelations()->get(),
            // 'mostCommented' => BlogPost::mostCommented()->take(2)->get(),
            // 'mostWrittenBlogPost' => User::mostBlogPostPosted()->take(3)->get(),
            // 'mostActiveAuthorLastMonth' => User::mostBlogPostPostedLastMonth()->take(3)->get(),
        ]);
    }
}
