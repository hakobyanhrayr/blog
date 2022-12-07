<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = ['user_id','post_id'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class,'like');
    }
}
