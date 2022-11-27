<?php

namespace App\Http\Controllers\User;

use App\Models\user\Post;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('user.blog',compact('posts'));
    }
}
