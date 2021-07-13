@extends('layouts.app')

@section('content')
<div class="task-form">
    <ul class="align-items-start" id="tasksList">
        <li>
            <div class="container align-items-start" id="add_task">
                <div class="taskInteractionContainer">
                    <button type="submit" id="showForm"><i class="fas fa-plus"></i></button>
                    <p>Create a new poll</p>
                </div>
            </div>
        </li>
        <li>
            <div class="activities-container d-none">
                <form action="/activities" method="POST" id="addForm">
                    @csrf
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="question">Add a new poll</label>
                            <label for="option_1">Option 1</label><br>
                            <label for="option_1">Option 2</label><br>
                            <label for="option_1">Option 3</label><br>
                            <label for="option_1">Option 4</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="question" id="question">
                            <input type="text" name="option_1" id="option_1">
                            <input type="text" name="option_2" id="option_2">
                            <input type="text" name="option_3" id="option_3">
                            <input type="text" name="option_4" id="option_4">
                        </div>
                        <div class="text-center mx-auto">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" id="cancelTask">Cancel</button>
                        </div>
                    </div>

                </form>
            </div>
        </li>
        <li>
            @if($polls)
            @foreach ($polls as $poll)
                    @foreach ($poll->options as $option)
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title text-center card bg-primary text-light mt-1 p-2" id="poll-title">
                                                {{$poll->question}}
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="radio">
                                                        <input type="radio"
                                                         name="option_1"
                                                         id="option_1"
                                                         value="{{$option->option_1}}"
                                                         checked
                                                         >
                                                        <label for="option_1">
                                                            {{$option->option_1}}
                                                        </label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="radio">
                                                        <input type="radio"
                                                        name="option_2"
                                                        id="option_2"
                                                        value="{{$option->option_2}}">
                                                        <label for="option_2">
                                                            {{$option->option_2}}
                                                        </label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="radio">
                                                        <input type="radio"
                                                        name="option_3"
                                                        id="option_3"
                                                        value="{{$option->option_3}}">
                                                        <label for="option_3">
                                                            {{$option->option_3}}
                                                        </label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="radio">
                                                        <input type="radio"
                                                        name="option_4"
                                                        id="option_3"
                                                        value="{{$option->option_4}}">
                                                        <label for="option_4">
                                                            {{$option->option_4}}
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="panel-footer text-center mt-2">
                                            <a href="#">View Result</a>
                                            <button type="button" class="btn btn-primary">
                                                Vote</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endif
        </li>
    </ul>
</div>
@endsection
