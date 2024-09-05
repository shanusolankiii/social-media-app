<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $like = Like::where('post_id', $post->id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$like) {
            Like::create([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'You liked the post.');
        }

        return redirect()->back()->with('error', 'You already liked this post.');
    }
    public function destroy(Post $post)
    {
        $like = Like::where('post_id', $post->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($like) {
            $like->delete();
            return redirect()->back()->with('success', 'You unliked the post.');
        }

        return redirect()->back()->with('error', 'You have not liked this post yet.');
    }

}
