<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Institute;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MasterCategoryController extends Controller
{
    //
    public function store_cat (Request $request){


        //

        // echo "failed";
        //

        // dd($request->all());
  // Handle file upload for institute

  $request->validate([
    'category_name' =>'unique:categories|max:100|min:1',
    // 'category_des' => 'required|max:255',
    'category_photo' => 'nullable|image|max:2048',

]);

            $CatPhotoPath = null;
             if ($request->hasFile('category_photo')) {
                     $CatPhotoPath = $request->file('category_photo')->store('cat_photos', 'public');
                    //  dd($CatPhotoPath);
            }




        Category::create([
            'category_name' => $request->category_name,
            'institute_id_fk' => $this->get_ins_id(),
            'category_des' => $request->category_des,
            'category_photo' => $CatPhotoPath ?? '',
        ]);

        return redirect()->back()->with('message' , 'Category Added Successfully');
    }



    public function show_cat($id){

        $user_role = Controller::getUserRoleName();
        // $user_id = Controller::getUserId();
        $ins_id = Controller::getInstituteId();


        // dd($user_id);
        session([$user_role.'.category.manage_category' => url()->previous()]);

        $categories = Category::where('institute_id_fk', $ins_id)->get();

        // dd($categories[1]->category_photo);

        $category_info = Category::where('institute_id_fk', $ins_id)->get();
        return view($user_role.'.category.manage_category' , compact('category_info' , 'categories'));

    }

    public function update_cat(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validate input
        $validateData = $request->validate([
            'category_name' => 'required|string|min:1|max:100',
            'category_des' => 'nullable|string|max:1000',
            'category_photo' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // Update basic fields
        $category->category_name = $validateData['category_name'];
        $category->category_des = $validateData['category_des'] ?? $category->category_des;

        // Handle photo replacement if a new one was uploaded
        if ($request->hasFile('category_photo')) {
            // Delete old photo if exists
            if ($category->category_photo && Storage::disk('public')->exists($category->category_photo)) {
                Storage::disk('public')->delete($category->category_photo);
            }

            // Store new photo in a specific folder by category ID
            $newPhotoPath = $request->file('category_photo')->store("categories/{$category->id}", 'public');
            $category->category_photo = $newPhotoPath;
        }

        // Save updated category
        $category->save();

        return redirect()->route('institute.category.manage')->with('message', 'Category updated successfully!');
    }


    public function get_ins_id(){
        // In your controller or anywhere where you need the user’s institute ID
        $userId = Auth::id();
        // Step 1: Get the current user's ID
        // dd($userId);
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



    public function delete_cat($id){

        $category = Category::findOrFail($id)->delete();


        // return redirect()->back()->with('message' , 'Category Deleted Successfully');
        // return redirect('institute/category/manage_category')->with('message' , 'Category Deleted Successfully');

        return redirect('institute/institute_profile')->with('message' , 'Category Deleted Successfully');

    }


}
