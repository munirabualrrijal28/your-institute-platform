<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CourseAdv;
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
    // Validate CourseAdv fields
    $validated = $request->validate([
        'course_adv_name' => 'required|string|max:100|unique:course_advs,course_adv_name',
        'course_adv_description' => 'nullable|string',
        'category_id_fk' => 'required|exists:categories,id'
    ]);

    $validated['institute_id_fk'] = Auth::user()->institute->id;

    // Create CourseAdv
    $courseAdv = CourseAdv::create($validated);

    // Create course-specific directory if not exists
    $folderPath = "course_advs/{$courseAdv->id}";
    if (!Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->makeDirectory($folderPath);
    }

    // Handle course photo (image)
    if ($request->hasFile('course_photo')) {
        $photo = $request->file('course_photo');
        $photoName = Str::random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs($folderPath, $photoName, 'public');

        $courseAdv->media()->create([
            'url' => "{$folderPath}/{$photoName}",
            'type' => $photo->getClientMimeType(),
        ]);
    }

    // Handle additional course files
    if ($request->hasFile('course_files')) {
        foreach ($request->file('course_files') as $file) {
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($folderPath, $filename, 'public');

            $courseAdv->media()->create([
                'url' => "{$folderPath}/{$filename}",
                'type' => $file->getClientMimeType(),
            ]);
        }
    }

    return redirect()->back()->with('message', 'Course Advertisement Added Successfully');
}
    public function get_edit_course_adv($id)
    {
        $course = CourseAdv::findOrFail($id);
        return response()->json($course);
    }

    public function show_course_adv($id){

//         $ins_id = Controller::getInstituteId();

//         // session(['admin.course_adv.manage_course_adv' => url()->previous()]);

//         // $course_advs = CourseAdv::where('institute_id_fk', $ins_id)->get();
// //
//         $course_adv_info = CourseAdv::findOrFail($id); // safer
//         $categories = Category::where('institute_id_fk', $ins_id)->get();

//         return view('institute.course_adv.manage_course_adv', compact('course_adv_info', 'categories'));

    }

    // public function update_course_adv(Request $request , $id){

    //     $course_adv = CourseAdv::findOrFail($id);

    //     $validate_data = $request->validate([
    //         'course_adv_name' =>'unique:course_advs|max:100|min:1',
    //         'category_name' =>'unique:categories',
    //         'category_id_fk' => 'required|exists:categories,id'
    //     ]);

    //     $course_adv->update($validate_data);

    //     // $categories = CourseAdv::all();
    //     // return redirect()->back()->with('message' , 'Category Updated Successfully');

    //     return redirect(session('admin.course_adv.manage_course_adv'))->with('message', 'Course Adv updated successfully!');



    // }

    public function edit_course_adv($id)
    {
        $course_adv = CourseAdv::findOrFail($id);
        $existingImage = $course_adv->media()->where('type', 'like', 'image/%')->first();

        dd($existingImage->url);



        return response()->json($course_adv);
    }



    public function update_course_adv(Request $request, $id)
    {


        $course_adv = CourseAdv::findOrFail($id);

        // Validation
        $request->validate([
            'course_adv_name' => 'required|string|max:100|unique:course_advs,course_adv_name,' . $id,
            'course_adv_description' => 'nullable|string',
            'category_id_fk' => 'required|exists:categories,id',
        ]);
        // dd("update fun public/course_adv");

        // Update main course_adv fields
        $course_adv->update([
            'course_adv_name' => $request->course_adv_name,
            'course_adv_description' => $request->course_adv_description,
            'category_id_fk' => $request->category_id_fk
        ]);

        $folderPath = "course_advs/{$course_adv->id}";
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        // ✅ Replace Course Photo
        if ($request->hasFile('course_photo')) {
            // Delete existing image
            $existingImage = $course_adv->media()->where('type', 'like', 'image/%')->first();
            if ($existingImage) {
                Storage::disk('public')->delete($existingImage->url);
                $existingImage->delete();
            }

            // Save new image
            $photo = $request->file('course_photo');
            $photoName = Str::random(20) .'.'. $photo->getClientOriginalExtension();
            $photo->storeAs($folderPath, $photoName, 'public');
            // dd("public/{$folderPath}");
            $course_adv->media()->create([
                'url' => "{$folderPath}/{$photoName}",
                'type' => $photo->getClientMimeType(),
            ]);
        }

        // ✅ Replace or Add Course Files
        if ($request->hasFile('course_files')) {
            foreach ($request->file('course_files') as $file) {
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs($folderPath, $filename, 'public');

                $course_adv->media()->create([
                    'url' => "{$folderPath}/{$filename}",
                    'type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('institute.manage_course_adv')->with('message', 'Course updated successfully');
    }

//


    public function delete_course_adv($id){

        $course_adv = CourseAdv::findOrFail($id)->delete();


        return redirect()->back()->with('message' , 'Course Adv Deleted Successfully');


    }


}
