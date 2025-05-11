<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Advertisements;
use App\Models\Category;
use App\Models\Courses;
use App\Models\Followers;
use App\Models\Institute;
use App\Models\Instructors;
use App\Models\Student;
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
        return view('user.home.home', compact('institutes'));


    }

    public function user_following()
    {

        $current_stu = Student::where('user_id_fk', Auth::id())->firstOrFail();

        // $isFollowing = $student ? $student->followingInstitutes()->where('institute_id', $institute->id)->exists() : false;
        $following = $current_stu->followedInstitutes;

        return view('user.profile.user_following');
    }

    public function user_profile()
    {


    $current_stu = Student::where('user_id_fk', Auth::id())->firstOrFail();


    // return view('user.institute_profile', compact('institute', 'isFollowing', 'followersList'));

        $following = $current_stu->followedInstitutes;
        // $categories = Category::where(, $ins_id)->paginate(8); // You can adjust 6 per page

        return view('user.profile.profile', compact(['current_stu', 'following']));


    }


    public function user_search()
    {

        return view('user.settings.settings');
    }


    public function user_settings()
    {
        $current_stu = Student::where('user_id_fk', Auth::id())->firstOrFail();
        $following = $current_stu->followedInstitutes;
                // $institute = Institute::withCount('followers')->findOrFail($id);

        // return view('user.settings.settings', compact(['current_stu', 'following' , 'institute']));
        return view('user.settings.settings', compact(['current_stu', 'following']));
    }


    //
    public function toggleFollow(Institute $institute)
    {
        //         $institute = Institute::findOrFail($id);
//         $student = Auth::user()->student;
// dd('l');
//         $alreadyFollowing = DB::table('followers')
//             ->where('student_id_fk', $student->id)
//             ->where('institute_id_fk', $institute->id)
//             ->exists();

        //         if (!$alreadyFollowing) {
//             DB::table('followers')->insert([
//                 'student_id_fk' => $student->id,
//                 'institute_id_fk' => $institute->id,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//         }

        //         return back()->with('message', 'Now following this institute.');



        $student = Auth::user()->student;

        if ($student->followingInstitutes()->where('institute_id', $institute->id)->exists()) {
            // Unfollow
            $student->followingInstitutes()->detach($institute->id);
        } else {
            // Follow
            $student->followingInstitutes()->attach($institute->id);
        }

        return back();
    }





    public function user_ins_profile($id)
    {
        $current_stu = Student::where('user_id_fk', Auth::id())->firstOrFail();
        $following = $current_stu->followedInstitutes;
        // $institute = Institute::with(['followers', 'advertisements'])->findOrFail($id);
        $institute = Institute::withCount('followers')->findOrFail($id);
        // dd($institute);
        $institute_tabs = $this->getInstituteTabs($id);

// $tabs = $this->getInstituteTabs($id);
$categories = $institute_tabs['categories'];
$courses = $institute_tabs['courses'];
$instructors = $institute_tabs['instructors'];
$ads = $institute_tabs['ads'];


//

// dd(Auth::user()->student->id);
//

        $isFollowing = false;

        if (Auth::check() && Auth::user()->role === 2) {
            $studentId = Auth::user()->student->id;
            $isFollowing = DB::table('followers')
                ->where('student_id_fk', $studentId)
                ->where('institute_id_fk', $institute->id)
                ->exists();
        }

        return view('user.profile.ins.ins_page', compact(['institute' ,  'isFollowing'  ,  'categories' , 'courses' ,
    'instructors' ,
    'ads' , 'following' ]));


    }



    public function getInstituteTabs($id)
    {
        $ins_id = $id;

        $categories = Category::where('institute_id_fk', $ins_id)->paginate(8); // You can adjust 6 per page
        //
        $courses = Courses::with([
            'category',
            'media',
            'comments.user'
        ])
            ->where('institute_id_fk', $ins_id)
            ->latest()
            ->paginate(8);
        //
        $instructors = Instructors::where('institute_id_fk', $ins_id)
            ->latest()
            ->paginate(6); // 4 cols × 2 rows = 8 cards per page
//
        $ads = Advertisements::with(['media', 'comments.user'])
            ->where('institute_id_fk', $ins_id)
            ->latest()
            ->paginate(8);

           return [
    'categories' => $categories,
    'courses' => $courses,
    'instructors' => $instructors,
    'ads' => $ads,
];
    }

    // to unpack values in the called distination function ex :
// $tabs = $this->getInstituteTabs($id);
// $categories = $tabs['categories'];
// $courses = $tabs['courses'];
// $instructors = $tabs['instructors'];
// $ads = $tabs['ads'];

}
