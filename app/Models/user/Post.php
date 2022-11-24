<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'body'
    ];
}
