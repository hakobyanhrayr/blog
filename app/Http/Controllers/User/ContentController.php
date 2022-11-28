<?php

namespace App\Http\Controllers\User;

use App\Models\user\Category;
use App\Models\user\Post;
use App\Http\Controllers\Controller;
use App\Models\user\Tag;

class ContentController extends Controller
{
    public function category(Category $category)
    {
//         $category = Category::query()->findOrFail($id);
        $posts = $category->posts();
        dd('category');
        return view('user.pivot',compact('posts'));
//        dd(111111111);
    }

    public function tag(Tag $tag)
    {
//         $category = Category::query()->findOrFail($id);
        $posts = $tag->posts();
        dd($tag->posts());
        return view('user.pivot',compact('posts'));
        dd(111111111);
    }
}
