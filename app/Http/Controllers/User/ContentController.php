<?php

namespace App\Http\Controllers\User;

use App\Models\user\Category;
use App\Models\user\Post;
use App\Http\Controllers\Controller;
use App\Models\user\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ContentController extends Controller
{
    /**
     * @param Category $category
     * @return Application|Factory|View
     */
    public function category(Category $category):View
    {
        $posts = $category->posts();

        return view('user.pivot',compact('posts'));
    }

    /**
     * @param Tag $tag
     * @return Application|Factory|View
     */
    public function tag(Tag $tag):View
    {
        $posts = $tag->posts();

        return view('user.pivot',compact('posts'));
    }
}
