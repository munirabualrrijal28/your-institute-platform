<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use Illuminate\Http\Request;

class UserMainController extends Controller
{

    // public function index(){
    //     return view('user.profile');


    // }



    public function user_home()
    {
        $institutes = Institute::all();
        return view('user.home.home' , compact('institutes'));


    }

    public function user_following()
    {

        return view('user.profile.user_following');
    }

    public function user_profile()
    {
        return view('user.profile.profile');


    }
    public function user_ins_profile()
    {
        return view('user.profile.ins.ins_page');


    }

    public function user_search()
    {

        return view('user.settings');
    }


    public function user_settings()
    {

        return view('user.settings');
    }


}
