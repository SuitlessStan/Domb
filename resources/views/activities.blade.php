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
                <form id="addForm">
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
            <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
        </li>
        <li>
            <div polls>
                <div poll class="container mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 data-source="question" class="panel-title text-center card bg-primary text-light mt-1 p-2" id="poll-title">

                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <input type="radio"
                                                 name="option_1"
                                                 id="option_1"
                                                 data-source="option_1"
                                                 checked
                                                 >
                                                <label for="option_1" data-source="option_1_label">

                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <input type="radio"
                                                name="option_2"
                                                id="option_2"
                                                data-source="option_2"
                                                >
                                                <label for="option_2" data-source="option_2_label">

                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <input type="radio"
                                                name="option_3"
                                                id="option_3"
                                                data-source="option_3">
                                                <label for="option_3" data-source="option_3_label">

                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <input type="radio"
                                                name="option_4"
                                                id="option_4"
                                                data-source="option_4">
                                                <label for="option_4" data-source="option_4_label">

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
            </div>

        </li>
    </ul>
</div>
@endsection

@section('javascript')
<script>
    getActivities();
    $('#addForm').submit(function(event){
        event.preventDefault();

        let question = $("input[name=question]").val();
        let option_1 = $("input[name=option_1]").val();
        let option_2 = $("input[name=option_2]").val();
        let option_3 = $("input[name=option_3]").val();
        let option_4 = $("input[name=option_4]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url:"/activities",
            type:"POST",
            data:{
                question:question,
                option_1:option_1,
                option_2:option_2,
                option_3:option_3,
                option_4:option_4,
                _token:_token,
            },
            success:function(response){
                $('.success').text(response.success);
                displayActivities(response);
            }
        })
    });

    function getActivities(){
        $.ajax({
            url:"/allActivities",
            type:"GET",
            success:function(response){
                console.log(response);
                displayActivities(response);
            }
        })
    }

    var $pollTemplate = $('[polls]').clone();
    $('[polls]').html('');

    function displayActivities(response){
        // $('[polls]').html('');
        var polls = '';
        pollsList = response.polls;
        $(pollsList).each(function(){

            var $poll = $pollTemplate.clone();
            $poll.find('[data-source="question"]').html(this.question);
            $(this.options).each(function(){
            $poll.find('[data-source="option_1"]').html(this.option_1);
            $poll.find('[data-source="option_2"]').html(this.option_2);
            $poll.find('[data-source="option_3"]').html(this.option_3);
            $poll.find('[data-source="option_4"]').html(this.option_4);
            $poll.find('[data-source="option_1_label"]').html(this.option_1);
            $poll.find('[data-source="option_2_label"]').html(this.option_2);
            $poll.find('[data-source="option_3_label"]').html(this.option_3);
            $poll.find('[data-source="option_4_label"]').html(this.option_4);
            })

            polls += $poll.html();
        });

        $('[polls]').append(polls);
    }

</script>
@endsection
