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
                    <label class="lead inherit" for="appointment">Add an Appointment </label>
                    <input type="text" name="appointment" id="appointment" class="inherit">
                    <button class="btn btn-primary inherit" type="submit">Add Appointment</button>
                </form>
            <button class="btn btn-danger" id="cancelTask">Cancel</button>
            </div>
        </li>
        @if($appointments)
        <li class="addedAppointments">

        </li>
        @endif
      
    </ul>
</div>
@endsection

@section('javascript')
<script>
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
        $.each(appointments,function(i,val){
            var appointmentHtmlContainer = "<li>";
                appointmentHtmlContainer+= "<div class='card task-container lead'>";
                appointmentHtmlContainer+= val.body;
                appointmentHtmlContainer+="</div>";
            $('.addedAppointments').append(appointmentHtmlContainer);
      });
    }
</script>

@endsection
