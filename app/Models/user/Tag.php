<?php

namespace App\Models\user;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug'
    ];


    public function posts(): LengthAwarePaginator
    {
        return $this->belongsToMany(Post::class,'post_tags')->orderBy('created_at','DESC')->paginate(5);
    }

//    /**
//     * @return string
//     */
//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }
}
