<?php

namespace App\Models\user;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Post extends Model
{
    protected $table = "posts";

    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'body',
        'status',
        'image'
    ];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'post_tags')->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_posts')->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * @return HasMany
     */
     public function dislikes(): HasMany
     {
         return $this->hasMany(Dislike::class);
     }
}
