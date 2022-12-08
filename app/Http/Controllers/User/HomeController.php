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

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
         $posts = Post::where('status',1)->with('likes')->paginate(2);
//        $posts = Post::where('status',1)->with('likes')->get();

//        $likes = Like::query()->count();
//
//        $posts = Post::where('status',1)->paginate(2);

        return view('user.blog',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
//    public function store(Request $request)
//    {
//        $userId = Auth::id();
//
//        $likes = Like::query()->where(['user_id'=>$userId,'post_id'=>$request->post])->get()->count();
//
////        dd($likes);
////        dd($userId);
//
//        if ($likes == 0){
//            Like::create([
//                'user_id'=>$userId,
//                'post_id'=>$request->post,
//            ]);
//        }
//
//          return back()->with('message','you liked this post');
//    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $post_id = $request->post;
        $user_id = Auth::id();

        $likes = Like::query()->where(['user_id'=>$user_id,'post_id'=>$post_id])->count();
         if ($likes == 0){
             $likeObj = new Like();
             $likeObj->user_id = $user_id;
             $likeObj->post_id = $post_id;

             $likeObj->save();
         }

        $post = Post::query()->find($post_id);

        $post->update($request->only([
            'title',
            'subtitle',
            'body',
            'publish',
            'status',
        ]));
//         dd($post->like);
        $post->like = $likes;

        $post->save();

        return back()->with('message','you liked this post');
    }
    /**
     * @param $id
     * @return void
     */
    public function show($id)
    {
        //
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
