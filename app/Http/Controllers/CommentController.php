<?php

namespace App\Http\Controllers;

use App\Models\Post;

class CommentController extends Controller
{
    public function __invoke(Post $post)
    {
        auth()->user()->comments()->create(array_merge(request()->validate([
            'body' => 'required|string'
        ]), [
            'post_id' => $post->id
        ]));

        return back();
    }
}
