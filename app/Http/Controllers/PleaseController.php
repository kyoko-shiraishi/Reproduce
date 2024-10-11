<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread; 

class PleaseController extends Controller
{
    public function index()
    {
        return view('please.index');
    }

    public function post(Request $request)
    {
        $validate_rule = [
            'mail' => 'email',
            'password' => 'required', 
        ];
        $this->validate($request, $validate_rule);
        return view('home.index', ['msg' => 'ログインしました']);
    }

  
    public function home()
    {
        $all_threads=Thread::all();
        return view('please.home',compact('all_threads'));
    
    }


    public function business(){
        return view('please.business');
    }
    public function infomation(){
        return view('please.infomation');
    }

    public function new_thread_create(){
        return view('please.new_thread_create');
    }
    
}

