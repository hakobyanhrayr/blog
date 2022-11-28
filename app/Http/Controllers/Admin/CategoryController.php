<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\user\Category;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CategoryController extends Controller
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

    //todo: see cursor()
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.show',compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        //todo: see tipitizeyshn;

        return view('admin.category.create');
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('category.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function show($id)
    {
          Category::query()->findOrFail($id);

        return redirect()->route('category.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = Category::query()->findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        $category = Category::query()->findOrFail($id);

        $category->update($request->validated());

        return redirect()->route('category.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id): RedirectResponse
    {
        $category = Category::query()->findOrFail($id);

        $category->delete();

        return redirect()->route('category.index');
    }
}
