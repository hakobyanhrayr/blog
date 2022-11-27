<?php

namespace App\Models\user;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Post extends Model
{
    protected $table = "posts";

    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'body',
        'status'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'post_tags')->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_posts')->withTimestamps();
    }

//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }
//
//    public function getCreatedAtAttribute($value): string
//    {
//        return Carbon::parse($value)->diffForHumans();
//    }
//
//    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(Like::class);
//    }
//
//    public function getSlugAttribute($value): string
//    {
//        return route('post',$value);
//    }
}
