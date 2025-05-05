<?php

namespace App\Http\Controllers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use App\Models\Institute;
use App\Constants\UserRole;
abstract class Controller
{
    //


    public function index() {
                // return view('institute.dashboard');

        return view('institute.home.home');
    }




    public function redirectToHome() {
        return redirect(AppServiceProvider::home_route());
    }




    
    public static function getUserRole() {
        $authUserRole = Auth::user()->role;
        $userId = Auth::user()->role;
        switch($userId){
            case UserRole::AdminRole:
                return UserRole::AdminRole ;
            case UserRole::InstituteRole:
                // return redirect()->route('institute');
                return UserRole::InstituteRole;

                default:
                return UserRole::UserRole;
            }


    }

    public static function getUserRoleName() {

        $userId = Auth::user()->role;
        switch($userId){
            case UserRole::AdminRole:
                return 'admin' ;
            case UserRole::InstituteRole:
                // return redirect()->route('institute');
                return 'institute';

                default:
                return 'user';
            }

    }
    public static function getUserId() {


        $userId = Auth::user()->id;
        return $userId;


    }

    public static function getInstituteId(){
        // In your controller or anywhere where you need the user’s institute ID
        $userId = Auth::id();
        // Step 1: Get the current user's ID

        $institute = Institute::where('user_id_fk', $userId)->first();
        // Step 2: Search the institutes table for the user_id_fk matching the current user's ID

        if ($institute) {
            $instituteId = $institute->id; // The institute_id from the found row
            // Step 3: If the institute exists, get the institute_id
                    // dd($instituteId);

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
