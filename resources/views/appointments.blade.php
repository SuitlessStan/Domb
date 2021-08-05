@extends('layouts.app')
@section('content')


<div class="task-form">
    <ul class="align-items-start" id="tasksList">
        <li>
            <div class="container align-items-start" id="add_task">
                <div class="taskInteractionContainer">
                    <button type="submit" id="showForm"><i class="fas fa-calendar-check"></i></button>
                    <p>Add Appointment</p>
                </div>
            </div>
        </li>
        <li>
            <div class="form-container d-none">
                <form id="addForm">
                    @csrf
                    <input type="text" name="appointment" id="appointment" class="w-100">
                    <button class="font-weight-bold text-dark" type="submit"><i class="fas fa-plus-circle"></i></button>
                    <button class="font-weight-bold text-dark" id="cancelTask"><i class="fas fa-minus-circle"></i></button>
                </form>
            </div>
        </li>
        @if($appointments)
        <li class="addedAppointments">

        </li>
        @endif

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
    getAppointments();
    $("#addForm").submit(function(event){
      event.preventDefault();

      let appointment = $("input[name=appointment]").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/appointments",
        type:"POST",
        data:{
          appointment:appointment,
          _token: _token,
        },
        success:function(response){
            $('.success').text(response.success);
            displayAppointments([response.appointment]);
            document.forms['addForm'].reset();
            $('.form-container').addClass('d-none');
            $('#add_task').removeClass('d-none');
        },
       });
  });


    function getAppointments(){
        $.ajax({
        url: "/allAppointments",
        type:"GET",
        success:function(response){
            displayAppointments(response.appointments);
        },
       });
    }

    function displayAppointments(appointments){
        var $dropdown = dropdownClone.clone();
        $dropdown.removeClass('d-none');
        $.each(appointments,function(i,val){
            var appointmentHtmlContainer = "<li>";
                appointmentHtmlContainer+= "<div class='task-container bg-info text-dark d-flex justify-content-between align-items-center' appointment-id="+val.id+">";
                appointmentHtmlContainer+= "<h5>"+val.body+"</h5>";
                appointmentHtmlContainer+=$dropdown.html();
                appointmentHtmlContainer+="</div>";
            $('.addedAppointments').append(appointmentHtmlContainer);
      });
    }
</script>

@endsection
