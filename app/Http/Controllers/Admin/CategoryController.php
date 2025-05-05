<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    public function manage_category(){
        //Log::info('Navigated to create category page');
        $categories = Category::all();

        return view('admin.category.manage_category' , compact('categories'));



    }
  public function manage(){
    $categories = Category::all();
        return view('admin.category.manage' , compact('categories')) ;
    }




}
