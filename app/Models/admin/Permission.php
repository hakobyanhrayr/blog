<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','for'];

    protected $table = 'permissions';
}
