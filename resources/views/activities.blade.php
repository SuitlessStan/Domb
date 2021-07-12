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
                @if($polls && $polls->options())
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <span class="glyphicon glyphicon-arrow-right"></span>How is My Site? <a href="http://www.jquery2dotnet.com" target="_blank"><span
                                            class="glyphicon glyphicon-new-window"></span></a>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios">
                                                    Good
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios">
                                                    Excellent
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios">
                                                    Bed
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios">
                                                    Can Be Improved
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios">
                                                    No Comment
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Vote</button>
                                    <a href="#">View Result</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </li>
    </ul>
</div>
@endsection
