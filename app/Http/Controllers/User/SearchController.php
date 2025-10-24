<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Advertisements;
use App\Models\Courses;
use App\Models\Institute;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->query('query');

        return view('user.search.results', [
            'query' => $query,
            'institutes' => Institute::where('ins_name', 'like', "%{$query}%")->get(),
            'courses' => Courses::where('course_name', 'like', "%{$query}%")
                ->orWhere('course_description', 'like', "%{$query}%")->get(),
            'ads' => Advertisements::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")->get(),
        ]);
    }
}



