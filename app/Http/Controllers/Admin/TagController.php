<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Models\user\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
//        dd('Tag');
        return view('admin.tag.show');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * @param TagRequest $request
     * @return Application|Factory|View
     */
    public function store(TagRequest $request)
    {
//        dd($request->all());
        $tag = Tag::create($request->validated());
        return view('admin.tag.show',compact('tag'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return 'tag';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
