<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    protected $table = 'roles';

    public $timestamps = true;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}
