<?php

namespace App\Http\Controllers\User;

use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertisements;
use App\Models\Category;
use App\Models\Courses;
use App\Models\Followers;
use App\Models\Institute;
use App\Models\Instructors;
use App\Models\Notifications;
use App\Models\Ratings;
use App\Models\Reports;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserMainController extends Controller
{

    // public function index(){
    //     return view('user.profile');


    public $notifications = [];
    public $unreadCount = 0;
    protected $paginationTheme = 'tailwind'; // ensure Tailwind styling


    public function loadNotifications()
    {
        $user = Auth::user();

        $this->notifications = Notifications::where('reciver_id', $user->id)
            ->where('reciver_type', \App\Models\User::class)
            ->latest()
            ->take(10)
            ->get();

        $this->unreadCount = Notifications::where('reciver_id', Auth::id())
            ->where('reciver_type', \App\Models\User::class)
            ->whereNull('read_at')
            ->count();
    }

    public function markAllAsRead()
    {
        Notifications::where('reciver_id', Auth::id())
            ->where('reciver_type', \App\Models\User::class)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->loadNotifications(); // Refresh the list
    }

    // }



    public function user_home()
    {
        $institutes = Institute::all();

        return view('user.home.home', compact(['institutes']));


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

        $user_photo = $current_stu->media();

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
    public function updateUserName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);







        $user = Auth::user();
        $user->update(['name' => $request->name]);

        if ($request->hasFile('photo')) {
            // Delete old profile photo
            $user->media()->where('type', 'profile_photo')->delete();

            // Store new photo
            $path = $request->file('photo')->store("media/users/{$user->id}", 'public');

            $user->media()->create([
                'url' => $path,
                'type' => 'profile_photo',
            ]);
        }

        return back()->with('message', 'Profile updated successfully.');
    }
    //

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }


        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', '✅ Password updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'confirm_password' => 'required',
        ]);






        $user = Auth::user();

        if (!Hash::check($request->confirm_password, $user->password)) {
            return back()->withErrors(['confirm_password' => '❌ Incorrect password']);
        }

        // Optionally delete related data
        $user->delete();

        // auth()->logout();

        // auth()->guard()->logout();

        Auth::logout();

        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }




    // ////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //
    // public function toggleFollow(Institute $institute)
    // {

    //     $student = Auth::user()->student;

    //     if ($student->followingInstitutes()->where('institute_id', $institute->id)->exists()) {
    //         // Unfollow
    //         $student->followingInstitutes()->detach($institute->id);
    //     } else {
    //         // Follow
    //         $student->followingInstitutes()->attach($institute->id);
    //     }

    //     return back();


    // }
    //
    public function toggleFollow($id)
    {

        $student = Auth::user()->student;
        $isFollowing = $student->followedInstitutes()->where('institute_id_fk', $id)->exists();

        if ($isFollowing) {
            $student->followedInstitutes()->detach($id);
        } else {
            $student->followedInstitutes()->attach($id);
        }

        return response()->noContent();
        // return back();


    }





    public function user_ins_profile($id)
    {

        //   $institute_ins = Institute::where('followers')->firstOrFail($id);
        $institute = Institute::withCount('followers')->findOrFail($id);

        // dd($institute);
        $followers_count = $institute->followers()->count();
        $current_stu = Student::where('user_id_fk', Auth::id())->firstOrFail();
        $following = $current_stu->followedInstitutes;
        // $institute = Institute::with(['followers', 'advertisements'])->findOrFail($id);
        // dd($institute);
        $institute_tabs = $this->getInstituteTabs($id);

        // $tabs = $this->getInstituteTabs($id);
        $categories = $institute_tabs['categories'];
        $courses = $institute_tabs['courses'];
        $instructors = $institute_tabs['instructors'];
        $ads = $institute_tabs['ads'];

        $student = $current_stu;
        //
        $hasRated = Ratings::where('user_id_fk', Auth::id())
            ->where('rated_id', $id)
            ->where('type', \App\Models\Institute::class)
            ->exists();
        // dd(Auth::user()->student->id);


        return view('user.profile.ins.ins_page', compact([
            'institute',

            'categories',
            'courses',
            'instructors',
            'ads',
            'following',
            'student',
            'followers_count',
            'hasRated'

        ]));


    }


    public function showCourses(Category $category)
    {


        $courses = $category->courses()->with('media')->paginate(9); // 9 per page

        return view('user.profile.ins.ins_cat_courses', compact('category', 'courses'));
    }



    // /////////////////////////////// //////// //////////////////


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




    public function store(Request $request)
    {
        $request->validate([
            'reportable_type' => 'required|string',
            'reportable_id' => 'required|integer',
            'reason' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Reports::create([
            'user_id_fk' => Auth::id(),
            'reportable_id' => $request->reportable_id,
            'reportable_type' => $request->reportable_type,
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Your report has been submitted.');
    }



    public function user_all_ins()
    {


        $institutes = Institute::latest()->paginate(16, ['*'], 'insPage');
        // $courses = Courses::latest()->paginate(16, ['*'], 'insPage');
        // $ads = Advertisements::latest()->paginate(16, ['*'], 'insPage');


        // return view('user.home.all_ins', compact(['institutes' , 'courses' , 'ads']));
        return view('user.home.all_ins', compact(['institutes']));



    }


    // to unpack values in the called distination function ex :
// $tabs = $this->getInstituteTabs($id);
// $categories = $tabs['categories'];
// $courses = $tabs['courses'];
// $instructors = $tabs['instructors'];
// $ads = $tabs['ads'];

}
