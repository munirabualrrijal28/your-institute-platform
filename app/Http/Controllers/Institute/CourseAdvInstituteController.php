<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Courses;
use App\Models\Media;
use Illuminate\Http\Request;

class CourseAdvInstituteController extends Controller
{
    //
    // public function index (){

    //     $categories = Category::all();
    //     $course_advs = Courses::with('category')->get();

    //     $editCourseAdv = null;
    //     if ($request->has('edit_id')) {
    //         $editCourseAdv = Courses::find($request->edit_id);
    //     }


    //     return view('institute.course.manage_course_adv' , compact('categories' , 'course_advs'));
    // }


    public function manage_course(Request $request)
    {
        $ins_id = Controller::getInstituteId();

        $categories = Category::where('institute_id_fk', $ins_id)->get();

        $courses = Courses::with([
            'category',
            'media',
            'comments.user'
        ])
        ->where('institute_id_fk', $ins_id)
        ->latest()
        ->paginate(8);

        $editCourse = null;
        if ($request->has('edit_id')) {
            $editCourseAdv = Courses::find($request->edit_id);
        }

        return view('institute.profile.institute_profile', compact('categories', 'courses', 'editCourse'));
    }



//

public function update_edit_course($id)
{

    $course = Courses::findOrFail($id);
    return response()->json($course );

}

 // public function edit_course_adv ($id){
        // $ins_id = Controller::getInstituteId();


        // // $course_advs = Courses::where('institute_id_fk', $ins_id)->get();

        // $course_advs = Courses::findOrFail($id); // safer
        // $categories = Category::where('institute_id_fk', $ins_id)->get();


        // return view('institute.course.edit_course_adv', compact('course_advs', 'categories'));





    // }courses



}
