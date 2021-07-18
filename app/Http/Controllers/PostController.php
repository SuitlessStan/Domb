<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        
    }
    public function store(Request $request){
        // dd('xx');

        $request->validate([
            'post'=>'required',
        ]);
        $post = Post::create([
            'body'=>$request->input('post'),
        ]);

        $post->save();

        return redirect()->route('media');

    }
}
