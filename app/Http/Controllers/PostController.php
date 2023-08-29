<?php

namespace App\Http\Controllers;

use App\Contracts\CounterContracts;
use App\Events\BlogPostCreated;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Http\Requests\StorePost;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Services\Counter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $counter;

    public function __construct(CounterContracts $counter)
    {
        $this->counter = $counter;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        // return view('posts.index', ['posts'=>BlogPost::withCount('comments')->orderBy('created_at', 'desc')->get()]);

       

        
        return view('posts.index', [
            'posts'=>BlogPost::lastestWithRelations()->get(),
            // 'mostCommented' => $mostCommented,
            // 'mostWrittenBlogPost' => $mostWrittenBlogPost,
            // 'mostActiveAuthorLastMonth' => $mostActiveAuthorLastMonth,
        
        ]);
        
        // dd(BlogPost::withCount('comments')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $this->authorize('posts.create');
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        //
        $validatedData['user_id'] = $request->user()->id;

        $blogPost = BlogPost::create($validatedData);

        event( new BlogPostCreated($blogPost) );
        

        if( $request->hasFile('thumbnail') ){

            $path = $request->file('thumbnail')->store('thumbnails');
            
            $blogPost->image()->save(
                Image::make([
                    'path' => $path,        
                ])
            );
            
            // dump(Storage::disk('public')->putFile('thumbnails', $file));

            // $filename1 = $file->storeAs('thumbnails', $blogPost->id . "." . $file->guessExtension());
            // $filename2 = Storage::putFileAs('thumbnails',$file, $blogPost->id . "." . $file->guessExtension());

            // // dump($filename1);
            // // dump($filename2);

            // dump(Storage::url($filename1));

        }
        


        
        // $blogPost->title = $request->input("title");
        // $blogPost->content = $request->input("content");
        // $blogPost->save();
        
        return redirect()->route('posts.show', ["post"=>$blogPost->id])->with("status", "Blog post was created");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // dd(BlogPost::findOrFail($id));

        
        // return view('posts.show', ['post'=>BlogPost::with( ['comments' => function($query) { return $query->Latest(); }] )->findOrFail($id)]);

        $blogPost = Cache::remember("blog_post_{$id}", 60, function() use($id) {
            return BlogPost::with('comments', 'user', 'tags', 'image', 'comments.user')->findOrFail($id);
        });
        
        // $counter = resolve(Counter::class);

        return view('posts.show', [
            'post'=> $blogPost,
            'counter' => $this->counter->increment("blog_post_{$id}", ['blog-post']),

         ]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = BlogPost::findOrFail($id);


        //MANUALLY CREATED USING GATE
        // if( Gate::denies('update-post', $post) ){
        //     abort(403, "You can't edit this post");
        // }

        /*
        *
        * SHORT HAND VERSION OF AUTHORIZATION
        *
        */
        $this->authorize($post);

        return view("posts.edit", ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $blog_post_edit = BlogPost::findOrFail($id);

        // if( Gate::denies('update-post', $blog_post_edit) ){
        //     abort(403, "You can't update this post");
        // }

        /*
        *
        * SHORT HAND VERSION OF AUTHORIZATION
        *
        */
        $this->authorize($blog_post_edit);

        $validatedData = $request->validated();

        

        $blog_post_edit->fill($validatedData);

        if($request->hasFile('thumbnail')){
            
            $path = $request->file('thumbnail')->store('thumbnails');

            

            if($blog_post_edit->image){
                Storage::delete($blog_post_edit->image->path);
                
                $blog_post_edit->image->path = $path;
                
                $blog_post_edit->image->save();
                

            }else{
                $blog_post_edit->image()->save(
                    Image::make([
                        'path' => $path,        
                    ])
                );
                
            
            }
        }
        $blog_post_edit->save();

        

        return redirect()->route('posts.show', ["post"=>$blog_post_edit->id])->with("status", "Blog post was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $blog_post_delete = BlogPost::findOrFail($id);

        // if( Gate::denies('delete-post', $blog_post_delete) ){
        //     abort(403, "You can't delete this post");
        // }

        /*
        *
        * SHORT HAND VERSION OF AUTHORIZATION
        *
        */
        $this->authorize($blog_post_delete);

        $blog_post_delete->delete();
        return redirect()->route('posts.index')->with("status", "Blog post was deleted");
    }
}
