<?php

namespace App\Http\Controllers\User;

use App\Models\user\Like;
use App\Models\user\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LikeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // dd('create');
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse|string
     */
    public function store(Request $request,Post $post)
    {
        $userId = Auth::id();

        Like::create([
            'user_id'=>$userId,
            'post_id'=>$request->post
        ]);

//        if($request->has('like')){
//             return 'у уже поставил Like';
//        }else{
//
//        }

//        $postId = Post::query()->findOrFail($id);

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //  dd('edit');
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
        // dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //  dd('destroy');
    }
}
