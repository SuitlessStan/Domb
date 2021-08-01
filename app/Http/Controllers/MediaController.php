<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class MediaController extends Controller
{
    public function index(){
        $posts = Post::with(['comments'])->get();
        return view('media',['posts'=>$posts]);
    }

    public function allPosts(){
        $posts = Post::with(['comments'])->get();
        return response()->json(
            ['posts'=>$posts,]
        );
    }
}
