<?php

namespace App\Models;

use App\Scopes\DeleteAdminScopes;
use App\Scopes\LatestScopes;
use App\Traits\Taggable;
use Faker\Core\Blood;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Taggable;
    
    protected $fillable = [
        'title',
        'content',
        'user_id'   
    ];

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable')->Latest();
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    

    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }


    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLastestWithRelations(Builder $query){
        $query->Latest()->withCount('comments')->with('user')->with('tags');
    }


    public static function boot(){

        static::addGlobalScope(new DeleteAdminScopes);
        

        parent::boot();

        // static::addGlobalScope(new LatestScopes);


        /*
        * 1st way, the 2nd way defined in the migration cascade
        *DELETE MODELS AND THE RELATIONAL MODELS
        *
        *   static::deleting(function(BlogPost $blogPost){
        *       $blogPost->comments()->delete();
        *   });
        *
        */

           static::deleting(function(BlogPost $blogPost){
                   $blogPost->comments()->delete();
                   Cache::tags(['blog_post'])->forget("blog_post_{$blogPost->id}");
            });

            static::updating(function(BlogPost $blogPost){
                Cache::tags(['blog_post'])->forget("blog_post_{$blogPost->id}");
            });
            
            static::restoring(function(BlogPost $blogPost){
                $blogPost->comments()->restore();
            });

    }
}
