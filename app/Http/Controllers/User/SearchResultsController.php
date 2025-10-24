<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institute;
use App\Models\Courses;
use App\Models\Advertisements;
use View;

class SearchResultsController extends Controller
{


   public function __invoke(Request $request)
    {
        $query = $request->input('query');

        $institutes = Institute::where('ins_name', 'like', "%{$query}%")->take(2)->get();
        $courses = Courses::where('course_name', 'like', "%{$query}%")
            ->orWhere('course_description', 'like', "%{$query}%")->get();

        $ads = Advertisements::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")->get();

        return view('user.search.results', compact('query', 'institutes', 'courses', 'ads'));
    }
}
