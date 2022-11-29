<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class,'like');
    }
}
