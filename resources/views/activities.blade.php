@extends('layouts.app')

@section('content')
<div class="task-form">
    <ul class="align-items-start" id="tasksList">
        <li>
            <div class="container align-items-start" id="add_activity">
                <div class="taskInteractionContainer">
                    <button type="submit" id="showForm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-poll"></i></button>
                    <p>Create a new poll</p>
                </div>
            </div>
        </li>
        <li>
            <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
        </li>
        <li>
            <div class="row" id="pollsContainer">
                <div class="col-md-6">
                    <div polls>
                        <div poll>
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
                                                 name="option"
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
                                                name="option"
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
                                                name="option"
                                                id="option_3"
                                                data-source="option_3">
                                                <label for="option_3" data-source="option_3_label">

                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <input type="radio"
                                                name="option"
                                                id="option_4"
                                                data-source="option_4">
                                                <label for="option_4" data-source="option_4_label">

                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="panel-footer text-center mt-2 d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-vote-yea"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center card bg-primary text-light mt-1 p-2">List of Polls</h3>
                        </div>
                        <div class="panel-body">
                            <ul List class="list-group">
                                <a href="#poll-title"><li class="list-group-item" data-source="list-item"></li></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="activityModel">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Submit a new poll</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-2">
                <form id="addForm">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="question">Add a new poll</label>
                            <label for="option_1">Option 1</label><br>
                            <label for="option_1">Option 2</label><br>
                            <label for="option_1">Option 3</label><br>
                            <label for="option_1">Option 4</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="question" id="question" class="w-100">
                            <input type="text" name="option_1" id="option_1">
                            <input type="text" name="option_2" id="option_2">
                            <input type="text" name="option_3" id="option_3">
                            <input type="text" name="option_4" id="option_4">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit Poll</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
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
                console.log(response);
                displayActivities(response);
            }
        })
    });

    function getActivities(){
        $.ajax({
            url:"/allActivities",
            type:"GET",
            success:function(response){
                // console.log(response);
                displayActivities(response);
                displayList(response);
            }
        })
    }

    var $pollTemplate = $('[poll]').clone();
    var $polls = $('[polls]');
    var $List = $('[List]');
    var $listClone = $('[List]').clone();
    $polls.empty();
    $List.empty();

    function displayActivities(response){
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

        $polls.append(polls);
    }

    function displayList(response){

        $(response.polls).each(function(i,val){
            var $listItem = $listClone.clone();
            $listItem.find('[data-source="list-item"]').html(val.question);
            $('[List]').append($listItem.html());
        })
    }

</script>
@endsection
