<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comments;
use App\Models\CourseAdv;
use App\Models\Media;
use Illuminate\Http\Request;

class CourseAdvInstituteController extends Controller
{
    //
    // public function index (){

    //     $categories = Category::all();
    //     $course_advs = CourseAdv::with('category')->get();

    //     $editCourseAdv = null;
    //     if ($request->has('edit_id')) {
    //         $editCourseAdv = CourseAdv::find($request->edit_id);
    //     }


    //     return view('institute.course_adv.manage_course_adv' , compact('categories' , 'course_advs'));
    // }


    public function manage_course_adv(Request $request)
    {
        $ins_id = Controller::getInstituteId();

        $categories = Category::where('institute_id_fk', $ins_id)->get();

        $course_advs = CourseAdv::with([
            'category',
            'media',
            'comments.user'
        ])
        ->where('institute_id_fk', $ins_id)
        ->latest()
        ->paginate(8);

        $editCourseAdv = null;
        if ($request->has('edit_id')) {
            $editCourseAdv = CourseAdv::find($request->edit_id);
        }

        return view('institute.course_adv.manage_course_adv', compact('categories', 'course_advs', 'editCourseAdv'));
    }


    // public function edit_course_adv ($id){
        // $ins_id = Controller::getInstituteId();


        // // $course_advs = CourseAdv::where('institute_id_fk', $ins_id)->get();

        // $course_advs = CourseAdv::findOrFail($id); // safer
        // $categories = Category::where('institute_id_fk', $ins_id)->get();


        // return view('institute.course_adv.edit_course_adv', compact('course_advs', 'categories'));





    // }

//

public function update_edit_course_adv($id)
{

    $course_adv = CourseAdv::findOrFail($id);
    return response()->json($course_adv );

}




}
