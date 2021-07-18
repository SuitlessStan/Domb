<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ajax;
use DB;

class AjaxController extends Controller
{
    public function create(){
        return view('create');
    }

    public function store(Request $request){

        ajax::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->mobile_number,
            'message'=>$request->message,
        ]);


        return response()->json(['success'=>'Got simple ajax request']);
    }
}
