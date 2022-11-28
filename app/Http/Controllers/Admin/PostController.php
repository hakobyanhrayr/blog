<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\user\Category;
use App\Models\user\Post;
use App\Models\user\Tag;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::all();

       return view('admin.post.show',compact('posts'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $tags = Tag::all();

        $categories = Category::all();

        return view('admin.post.create',compact('tags','categories'));
    }

    /**
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $post = Post::query()->create($request->only([
           'title',
           'subtitle',
           'slug',
           'body',
           'publish',
           'status',
           'image'
       ]));

        $path = $request->file('image')->store('public/images');

        $post->image = $path;

        $post->tags()->sync($request->tag);

        $post->categories()->sync($request->category);

        $post->status = $request->status;

        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $post = Post::query()->find($id);

       return view('admin.post.show',compact('post'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
      // $post = Post::query()->find($id);
        $post = Post::with('tags','categories')->where('id',$id)->first();

        $tags = Tag::all();

        $categories = Category::all();

        return view('admin.post.edit',compact('post', 'tags','categories'));

    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PostRequest $request, $id): RedirectResponse
    {

        $this->validate($request,[
            'title'=>'required',
            'subtitle'=>'required',
            'slug'=>'required',
            'body'=>'required',
            'image'=>'required',
        ]);

        if ($request->hasFile('image')){
            $imageName = $request->image->store('public/images');
        }

        $post = Post::query()->find($id);

        $post->image = $imageName;

        $post->title = $request->title;

        $post->subtitle = $request->subtitle;

        $post->slug = $request->slug;

        $post->body = $request->body;

        $post->status = $request->status;

        $post->save();

        $post->tags()->sync($request->tags);

        $post->categories()->sync($request->categories);

//        dd($request->toArray());

        return redirect()->route('post.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id): RedirectResponse
    {
        $post = Post::query()->find($id);

        $post->delete();

        return redirect()->route('post.index');
    }
}
