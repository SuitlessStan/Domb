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
            <li>
                <div class="container align-items-start" id="add_task">
                    <div class="taskInteractionContainer">
                        <button type="submit" id="showForm"><i class="fas fa-tasks"></i></button>
                        <p>Add Task</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="form-container d-none">

                <form id="addForm">
                        <label class="lead" for="task">Add a task </label>
                        <input type="text" name="task" id="task">
                        <button class="btn btn-primary submitTask" type="submit">Add task</button>
                </form>
                <button class="btn btn-danger" id="cancelTask">Cancel</button>
                </div>
            </li>
            @if ($tasks)
            <li class="addedTasks">

            </li>
             @endif
            <li>
                <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
            </li>
        </ul>
    </div>
@endsection

@section('javascript')
<script>
    getTasks();
    $("#addForm").submit(function(event){
      event.preventDefault();

      let task = $("input[name=task]").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/tasks",
        type:"POST",
        data:{
          task:task,
          _token: _token
        },
        success:function(response){
            $('.success').text(response.success);
            displayTasks([response.task]);
            document.forms['addForm'].reset();
            $('.form-container').addClass('d-none');
            $('#add_task').removeClass('d-none');


        },
       });
  });
//   Fetch all the tasks dynamically
  function getTasks(){
    $.ajax({
        url: "/allTasks",
        type:"GET",
        success:function(response){
            displayTasks(response.tasks);
        },
       });
  }

  function displayTasks(tasks){
      $.each(tasks,function(i,val){
            var   taskHtmlContainer = "<li>";
                taskHtmlContainer+= "<div class='card task-container lead bg-warning text-dark'>";
                taskHtmlContainer+= val.body;
                taskHtmlContainer+="</div>";
        $('.addedTasks').append(taskHtmlContainer);

      });


  }

</script>
@endsection
