@extends('layouts.app')
@section('content')
{{-- <div class="container list-items">
    <div class="item-in-list">
        Task 1
    </div>
    <div class="item-in-list">
        Task 2
    </div>
    <div class="item-in-list">
        Task 3
    </div>
</div> --}}

<div class="task-form">
    <ul class="align-items-start" id="tasksList">
        @if ($tasks)
        @foreach ($tasks as $task )
        <li>
            <div class="card task-container lead">
                {{$task->body}}
            </div>
        </li>
        @endforeach
        @endif
        <li>
            <div class="container align-items-start" id="add_task">
                <div class="taskInteractionContainer">
                    <button type="submit" id="showForm"><i class="fas fa-plus"></i></button>
                    <p>Add Task</p>
                </div>
            </div>
        </li>
        <li>
            <div class="form-container d-none">

                <form action="/tasks" method="POST" id="addForm">
                    @csrf
                    <label class="lead" for="task">Add a task </label>
                    <input type="text" name="task" id="task">
                    <button class="btn btn-primary" type="submit">Add task</button>
            </form>
            <button class="btn btn-danger" id="cancelTask">Cancel</button>
            </div>
        </li>
    </ul>
</div>
@endsection
