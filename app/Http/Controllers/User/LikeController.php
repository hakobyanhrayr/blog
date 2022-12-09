<?php

namespace App\Http\Controllers\User;

use App\Models\user\Dislike;
use App\Models\user\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function likes(Request $request): RedirectResponse
    {
        $post_id = $request->post;
        $user_id = Auth::id();
//        dd($user_id);

        $likes = Like::query()->where(['user_id'=>$user_id,'post_id'=>$post_id])->count();

        if ($likes == 0){
            $likeObj = new Like();
            $likeObj->user_id = $user_id;
            $likeObj->post_id = $post_id;

            $likeObj->save();
        }
        return back()->with('message','you liked this post');
    }

//    /**
//     * @param Request $request
//     * @return RedirectResponse
//     */
//    public function dislike(Request $request): RedirectResponse
//    {
//        $post_id = $request->post;
//
//        $user_id = Auth::id();
//
//        $dislikes = Dislike::query()->where(['user_id'=>$user_id,'post_id'=>$post_id])->count();
//
//        if ($dislikes == 0){
//            $dis = new Dislike();
//            $dis->post_id = $post_id;
//            $dis->user_id = $user_id;
//
//            $dis->save();
//        }
//        return back()->with('message','you disliked this post');
//    }
}
