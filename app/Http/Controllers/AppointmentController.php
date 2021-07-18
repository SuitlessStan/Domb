<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::all();
            return view('appointments',['appointments'=>$appointments]);
    }

    public function allAppointments(){
        $appointments = Appointment::all();
            return response()->json([
            'appointments'=>$appointments,
            ]);
    }

    public function store(){
        request()->validate(
            ['appointment'=>'required']
        );
        $appointment = Appointment::create([
            'body'=>request('appointment'),
            'completed'=>'0',
        ]);

            return response()->json([
                'success'=> 'Task added!',
                'appointment'=>$appointment,
            ]);
    }
}
