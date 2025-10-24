<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institute;
use App\Models\Student;
use App\Models\User;
class AdmindashController extends Controller
{
    //
       public function index()
{
    // Count only users who are students
    // $userCount = \App\Models\User::where('role', 2)->count();

    // Count actual student records
    // $studentCount = \App\Models\Student::count();

    // Count institutes (from institutes table)
    // $instituteCount = \App\Models\Institute::count();

    // $verifiedCount = \App\Models\Institute::where('ins_is_verified', true)->count();
    // $unverifiedCount = \App\Models\Institute::where('ins_is_verified', false)->count();

    // return view('admin.dashboard', [
    //     'userCount' => $userCount,
    //     'studentCount' => $studentCount,
    //     'instituteCount' => $instituteCount,
    //     'verifiedCount' => $verifiedCount,
    //     'unverifiedCount' => $unverifiedCount,
    // ]);
      return view('admin.dashboard', [
        'userCount' => User::count(),
        'studentCount' => Student::count(),
        'verifiedCount' => Institute::where('ins_is_verified', true)->count(),
        'unverifiedCount' => Institute::where('ins_is_verified', false)->count(),
    ]);
}



}




