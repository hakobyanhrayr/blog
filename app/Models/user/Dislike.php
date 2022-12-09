<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property int $user_id
 * @property int $post_id
 **/
class Dislike extends Model
{
    protected $table = 'dislike';

    protected $fillable = ['user_id','post_id'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class,'like');
    }
}
