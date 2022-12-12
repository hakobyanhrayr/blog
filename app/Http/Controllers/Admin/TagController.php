<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Models\user\Tag;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TagController extends Controller
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
        $tags = Tag::get();

        return view('admin.tag.show', compact('tags'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View
    {
        return view('admin.tag.create');
    }

    /**
     * @param TagRequest $request
     * @return RedirectResponse
     */
    public function store(TagRequest $request): RedirectResponse
    {
        Tag::create($request->only(['name', 'slug']));

        return redirect()->route('tag.index')->with('message', 'Tag update SuccessFully');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id): View
    {
        Tag::query()->findOrFail($id);

        return view('admin.tag.show');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $tag = Tag::query()->findOrFail($id);

        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * @param TagRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TagRequest $request, int $id): RedirectResponse
    {
        $tag = Tag::query()->findOrFail($id);

        $tag->update($request->validated());

        return redirect()->route('tag.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $tag = Tag::query()->findOrFail($id);

        $tag->delete();

        return redirect()->route('tag.index');
    }
}
