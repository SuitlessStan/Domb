<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\StorePollRequest;
use App\Models\Poll;
use Illuminate\Http\Request;
use DB;

class ActivityController extends Controller
{
    public function index(){
        $polls = Poll::with(['options'])->get();
        return view('activities', compact('polls'));
        // return view('activities',[
        //     'polls'=>$polls,
        // ]);
    }

    public function store(Request $request){
        $request->validate([
            'question'=>'required|min:5',
            'option_1'=>'required',
            'option_2'=>'required',
        ]);

        $poll = Poll::create([
            'question'=>$request->input('question'),
        ]);

        $poll->options()->create([
            'option_1'=>$request->input('option_1'),
            'option_2'=>$request->input('option_2'),
            'option_3'=>$request->input('option_3'),
            'option_4'=>$request->input('option_4'),
        ]);

        $poll->save();

        return redirect()->route('activities');


    }
}
