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
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $posts = Post::get();

        return view('admin.post.show', compact('posts'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $tags = Tag::get();

        $categories = Category::query()->get();

        return view('admin.post.create', compact('tags', 'categories'));
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
        ]));

//        $path = $request->file('image')->store('public/images');

//        $path = Storage::putFile('public/images', $request->file('image'));

        $path = Storage::disk('local')->put('public/images', $request->file('image'));

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
    public function show(int $id): View
    {
        //findorfail
        $post = Post::query()->find($id);

        return view('admin.post.show', compact('post'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View
    {
        //findorfail
        $post = Post::with('tags', 'categories')->where('id', $id)->first();

        //cursor, get, all
        $tags = Tag::all();

        $categories = Category::all();

        return view('admin.post.edit', compact('post', 'tags', 'categories'));

    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(PostRequest $request, $id): RedirectResponse
    {

//        $this->validate($request, [
//            'title' => 'required',
//            'subtitle' => 'required',
//            'slug' => 'required',
//            'body' => 'required',
//            'image' => 'required',
//        ]);


        $post = Post::query()->find($id);

        $post->update($request->only([
            'title',
            'subtitle',
            'body',
            'publish',
            'status',
        ]));
//          -----
        if ($request->hasFile('image')) {
            $imageName = $request->image->store('public/images');
        };

        $post->image = $imageName;

//        $post->title = $request->title;

//        $post->subtitle = $request->subtitle;

//        $post->slug = $request->slug;

//        $post->body = $request->body;

//        $post->status = $request->status;


        $post->tags()->sync($request->tags);

        $post->categories()->sync($request->categories);

        $post->save();

        return redirect()->route('post.index')->with('message', 'Post update SuccessFully');

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
