<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $postID)
    {

        // dd('xx');
        $request->validate([
            'comment'=>'required'
        ]);

        $comment = Comment::create([
            'body'=>$request->input('comment'),
            'post_id'=>$postID,
        ]);

        // return redirect()->route('media');
        return response()->json([
            'comment'=>$comment,
            'success'=>'comment added!'
        ]);

    }
}
