<?php

namespace App\Http\Controllers\User;

use App\Models\user\Dislike;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DislikeController extends Controller
{
    public function dislike(Request $request): RedirectResponse
    {
        $post_id = $request->post;

        $user_id = Auth::id();

        $dislikes = Dislike::query()->where(['user_id'=>$user_id,'post_id'=>$post_id])->count();

        if ($dislikes == 0){
            $dis = new Dislike();
            $dis->post_id = $post_id;
            $dis->user_id = $user_id;

            $dis->save();
        }
        return back()->with('message','you disliked this post');
    }
}
