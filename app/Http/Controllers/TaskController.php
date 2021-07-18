<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('tasks',['tasks'=>$tasks,]);
    }

    public function allTasks(){
        $tasks = Task::all();
        return response()->json([
            'tasks'=>$tasks,
        ]);
    }

    public function store(Request $request){
        request()->validate([
            'task'=>'required',
        ]);

        $task = Task::create([
            'body'=>$request->task,
            'completed'=>'0'
        ]);

        return response()->json([
            'success'=>'Task added!',
            'task' => $task
        ]);

    }
}
