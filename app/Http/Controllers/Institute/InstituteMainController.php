<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class InstituteMainController extends Controller
{
    public function index (){
        // return view('institute.dashboard');
        //
        // return view('institute.home.home');

        //
        $institute = Institute::where('user_id_fk', $this->get_ins_id())->first();

        return view('institute.profile.institute_profile', compact('institute'));

    }
    // public function ins_welcome (){
    //     return view('institute.home.homee');


    // }

    public function institute_profile (){
        // return view('institute.home.home');
           //
           $institute = Institute::where('user_id_fk', $this->get_ins_id())->first();
// ProfileController.php
$institute = Cache::remember('institute_' . Auth::id(), 3600, function () {
    return auth()->user()->institute;
});
        //    return view('institute.home.home', compact('institute'));
        return view('institute.profile.institute_profile', compact('institute'));



    }

    public function institute_settings (){
        return view('institute.institute_settings');

    }


    // public function institute_profile (){
    //     return view('institute.profile.institute_profile');
    //     // return view('institute.dashboard');

    // }

    public function get_ins_id(){
        // In your controller or anywhere where you need the user’s institute ID
        $userId = Auth::id();
        // Step 1: Get the current user's ID

        $institute = Institute::where('user_id_fk', $userId)->first();
        // Step 2: Search the institutes table for the user_id_fk matching the current user's ID

        if ($institute) {
            $instituteId = $institute->institute_id; // The institute_id from the found row
            // Step 3: If the institute exists, get the institute_id
            return $instituteId;
        } else {
            // Handle case where no institute is found for the current user
            // For example, show a message or redirect
            $instituteId = null;
            return 1;
        }
        // You can use $instituteId here as needed

    }


}

