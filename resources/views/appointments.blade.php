@extends('layouts.app')
@section('content')


<div class="task-form">
    <ul class="align-items-start" id="tasksList">
        @if ($appointments)
        @foreach ($appointments as $appointment)
            <li>
                <div class="card task-container lead">
                {{$appointment->body}}
                </div>
            </li>
        @endforeach
        @endif
        <li>
            <div class="container align-items-start" id="add_task">
                <div class="taskInteractionContainer">
                    <button type="submit" id="showForm"><i class="fas fa-plus"></i></button>
                    <p>Add Appointment</p>
                </div>
            </div>
        </li>
        <li>
            <div class="form-container d-none">
                <form action="/appointments" method="POST" id="addForm">
                    @csrf
                    <label class="lead inherit" for="appointment">Add an Appointment </label>
                    <input type="text" name="appointment" id="appointment" class="inherit">
                    <button class="btn btn-primary inherit" type="submit">Add Appointment</button>
                </form>
            <button class="btn btn-danger" id="cancelTask">Cancel</button>
            </div>
        </li>
    </ul>
</div>
@endsection
