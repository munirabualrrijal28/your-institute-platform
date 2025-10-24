<?php

namespace App\Http\Controllers\Institute;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Institute;
use Illuminate\Http\Request;

class CategoryInstituteController extends Controller
{
    //
    public function index(){

        session(['institute.category.manage' => url()->previous()]);


        $ins_id = Controller::getInstituteId();

    // ✅ Use pagination here
    $categories = Category::where('institute_id_fk', $ins_id)->paginate(8); // You can adjust 6 per page

    // ✅ Return partial view if AJAX
    // if (request()->ajax()) {
    //     return view('institute.category.parts.category_cards', compact('categories'))->render();
    // }


        // $categories = Category::where('institute_id_fk', $ins_id)->get();
//

        return view('institute.category.manage_category' , compact( 'categories'));

    }

  public function edit_category($id){
    $category_info = Category::find($id);
        return view('institute.category.edit_category' , compact('category_info' ));
    }

  public function manage(){
        return view('institute.category.manage');
    }


      public function showInsCourses(Category $category)
{

        $courses = $category->courses()->with('media')->paginate(9); // 9 per page

        return view('institute.profile.ins_cat_courses', compact('category', 'courses'));

    }




}
