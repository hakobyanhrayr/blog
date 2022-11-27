<?php

namespace App\Http\Controllers\User;

use App\Models\user\Category;
use App\Models\user\Post;
use App\Http\Controllers\Controller;
use App\Models\user\Tag;

class ContentController extends Controller
{
    public function category(Category $category,$id)
    {
//         $category = Category::query()->findOrFail($id);
//         $posts = $category->posts();
//        return view('user.blog',compact('posts'));
    }
}
