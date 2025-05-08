<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;




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

        $current_ins = Institute::where('id' , Auth::id())->first();

    // $categories = Category::where(, $ins_id)->paginate(8); // You can adjust 6 per page

        return view('user.profile.profile' , compact('current_ins'));


    }


    public function user_search()
    {

        return view('user.settings');
    }


    public function user_settings()
    {
        $current_ins = Institute::where('id' , Auth::id())->first();

        return view('user.settings'   ,  compact('current_ins'));
    }

    //
    public function follow($id)
{
    $institute = Institute::findOrFail($id);
    $student = Auth::user()->student;

    $alreadyFollowing = DB::table('followers')
        ->where('student_id_fk', $student->id)
        ->where('institute_id_fk', $institute->id)
        ->exists();

    if (!$alreadyFollowing) {
        DB::table('followers')->insert([
            'student_id_fk' => $student->id,
            'institute_id_fk' => $institute->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return back()->with('message', 'Now following this institute.');
}




public function user_ins_profile($id)
{
    $institute = Institute::withCount(['followers', 'advertisements'])->findOrFail($id);

    $isFollowing = false;

    if (Auth::check() && Auth::user()->role === 3) {
        $studentId = Auth::user()->student->id;
        $isFollowing = DB::table('followers')
            ->where('student_id_fk', $studentId)
            ->where('institute_id_fk', $institute->id)
            ->exists();
    }

    return view('user.profile.ins.ins_page', compact('institute', 'isFollowing'));
}


}
