<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class MasterCourseAdvController extends Controller
{
    //



public function store_course_adv(Request $request)
{
    // Validate Courses fields
    $validated = $request->validate([
        'course_name' => 'required|string|max:100|unique:courses,course_name',
        'course_description' => 'nullable|string',
        'category_id_fk' => 'required|exists:categories,id'
    ]);

    $validated['institute_id_fk'] = Auth::user()->institute->id;

    // Create Courses
    $course = Courses::create($validated);

    // Create course-specific directory if not exists
    $folderPath = "course_advs/{$course->id}";
    if (!Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->makeDirectory($folderPath);
    }

    // Handle course photo (image)
    if ($request->hasFile('course_photo')) {
        $photo = $request->file('course_photo');
        $photoName = Str::random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs($folderPath, $photoName, 'public');

        $course->media()->create([
            'url' => "{$folderPath}/{$photoName}",
            'type' => $photo->getClientMimeType(),
        ]);
    }

    // Handle additional course files
    if ($request->hasFile('course_files')) {
        foreach ($request->file('course_files') as $file) {
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($folderPath, $filename, 'public');

            $course->media()->create([
                'url' => "{$folderPath}/{$filename}",
                'type' => $file->getClientMimeType(),
            ]);
        }
    }

    return redirect()->back()->with('message', 'Course Advertisement Added Successfully');
}
    public function get_edit_course_adv($id)
    {
        $course = Courses::findOrFail($id);
        return response()->json($course);
    }

    public function show_course_adv($id){

//         $ins_id = Controller::getInstituteId();

//         // session(['admin.course.manage_course_adv' => url()->previous()]);

//         // $course_advs = Courses::where('institute_id_fk', $ins_id)->get();
// //
//         $course_adv_info = Courses::findOrFail($id); // safer
//         $categories = Category::where('institute_id_fk', $ins_id)->get();

//         return view('institute.course.manage_course_adv', compact('course_adv_info', 'categories'));

    }

    // public function update_course_adv(Request $request , $id){

    //     $course = Courses::findOrFail($id);

    //     $validate_data = $request->validate([
    //         'course_name' =>'unique:course_advs|max:100|min:1',
    //         'category_name' =>'unique:categories',
    //         'category_id_fk' => 'required|exists:categories,id'
    //     ]);

    //     $course->update($validate_data);

    //     // $categories = Courses::all();
    //     // return redirect()->back()->with('message' , 'Category Updated Successfully');

    //     return redirect(session('admin.course.manage_course_adv'))->with('message', 'Course Adv updated successfully!');



    // }

    public function edit_course_adv($id)
    {
        $course = Courses::findOrFail($id);
        $existingImage = $course->media()->where('type', 'like', 'image/%')->first();

        dd($existingImage->url);



        return response()->json($course);
    }



    public function update_course_adv(Request $request, $id)
    {


        $course = Courses::findOrFail($id);

        // Validation
        $request->validate([
            'course_name' => 'required|string|max:100|unique:courses,course_name,' . $id,
            'course_description' => 'nullable|string',
            'category_id_fk' => 'required|exists:categories,id',
        ]);
        // dd("update fun public/course");

        // Update main course fields
        $course->update([
            'course_name' => $request->course_name ?? '',
            'course_description' => $request->course_description,
            'category_id_fk' => $request->category_id_fk
        ]);

        $folderPath = "courses/{$course->id}";
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        // ✅ Replace Course Photo
        if ($request->hasFile('course_photo')) {
            // Delete existing image
            $existingImage = $course->media()->where('type', 'like', 'image/%')->first();
            if ($existingImage) {
                Storage::disk('public')->delete($existingImage->url);
                $existingImage->delete();
            }

            // Save new image
            $photo = $request->file('course_photo');
            $photoName = Str::random(20) .'.'. $photo->getClientOriginalExtension();
            $photo->storeAs($folderPath, $photoName, 'public');
            // dd("public/{$folderPath}");
            $course->media()->create([
                'url' => "{$folderPath}/{$photoName}",
                'type' => $photo->getClientMimeType(),
            ]);
        }

        // ✅ Replace or Add Course Files
        if ($request->hasFile('course_files')) {
            foreach ($request->file('course_files') as $file) {
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs($folderPath, $filename, 'public');

                $course->media()->create([
                    'url' => "{$folderPath}/{$filename}",
                    'type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('institute.manage_course')->with('message', 'Course updated successfully');
    }

//


    public function delete_course_adv($id){

        $course = Courses::findOrFail($id)->delete();


        return redirect()->back()->with('message' , 'Course Deleted Successfully');


    }


}
