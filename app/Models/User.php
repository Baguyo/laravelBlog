<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Const_;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    

    public const LOCALES = [
        'en' => 'English',
        'es' => 'Spanish',
        'de' => 'Deutch'
    ];

    public function blogPosts(){
        return $this->hasMany("App\Models\BlogPost");
    }

    public function comments(){
        return $this->hasMany("App\Models\Comment");
    }

    public function commentsOn(){
        return $this->morphMany('App\Models\Comment', 'commentable')->Latest();
    }

    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    //LOCAL QUERY SCOPES
    public function scopeMostBlogPostPosted(Builder $query)
    {   
        return $query->withCount('blogPosts')->orderBy('blog_posts_count', 'desc');
    }

    public function scopeMostBlogPostPostedLastMonth(Builder $query)
    {
        return $query->withCount( ['blogPosts' => function( Builder $query){
            $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);
        }] )->has('blogPosts', '>=', 2)
            ->orderBy('blog_posts_count','desc');
    }

    public function scopeThatHasCommentedOnBlogPost( Builder $query , BlogPost $blogPosts ){
        return $query->whereHas( 'comments', function($query) use($blogPosts){
            $query->where('commentable_id', '=',  $blogPosts->id)
            ->where('commentable_type', '=', BlogPost::class);
        } );
    }

    public function scopeThatIsAdmin(Builder $query){
        return $query->where('is_admin', true);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'email_verified_at',
        'two_factor_confirmed_at',
        'profile_photo_url',
        'locale',
        'is_admin',
        'created_at',
        'updated_at',
        'current_team_id',
        'email',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
