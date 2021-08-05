@extends('layouts.app')

@section('content')
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
                    <input type="text" name="task" id="task" class="w-100">
                    <button class="font-weight-bold text-dark submitTask" type="submit"><i class="fas fa-plus-circle"></i></button>
                    <button class="font-weight-bold text-dark" id="cancelTask"><i class="fas fa-minus-circle"></i></button>
                </form>
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
    <div dropdown class="d-none">
        <div class="dropdown">
            <button class="text-dark" type="button" id="dropdownMenuButton" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false">
                <i class="fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Edit</a>
              <a class="dropdown-item" href="#">Delete</a>
            </div>
          </div>
    </div>
@endsection

@section('javascript')
<script>

    var dropdownClone = $('[dropdown]').clone();

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
      var $dropdown = dropdownClone.clone();
      $dropdown.removeClass('d-none');
      $.each(tasks,function(i,val){
            var   taskHtmlContainer = "<li>";
                taskHtmlContainer+= "<div class='task-container lead bg-warning text-dark d-flex justify-content-between align-items-center' task-id="+val.id+">";
                taskHtmlContainer+= "<h5>"+val.body+"</h5>";
                taskHtmlContainer+=$dropdown.html();
                taskHtmlContainer+="</div>";
        $('.addedTasks').append(taskHtmlContainer);

      });


  }



</script>
@endsection
