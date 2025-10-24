<?php

namespace App\Livewire\Search;

use App\Models\Advertisements;
use App\Models\Courses;
use App\Models\Institute;
use Livewire\Component;

class SearchComponent extends Component
{
 public $query = '';




    public function render()
{
    if (strlen($this->query) < 2) {
        return view('livewire.search.search-component', [
            'institutes' => collect(),
            'courses' => collect(),
            'ads' => collect(),
        ]);
    }

    $institutes = Institute::where(function ($q) {
        $q->where('ins_name', 'like', '%' . $this->query . '%')
          ->orWhere('ins_description', 'like', '%' . $this->query . '%');
    })->orderBy('created_at', 'desc')->get();

    $courses = Courses::where(function ($q) {
        $q->where('course_name', 'like', '%' . $this->query . '%')
          ->orWhere('course_description', 'like', '%' . $this->query . '%');
    })->orderBy('created_at', 'desc')->get();

    $ads = Advertisements::where(function ($q) {
        $q->where('title', 'like', '%' . $this->query . '%')
          ->orWhere('content', 'like', '%' . $this->query . '%');
    })->orderBy('created_at', 'desc')->get();

    return view('livewire.search.search-component', compact('institutes', 'courses', 'ads'));
}


//     public function render()
// {
//     return view('livewire.search.search-component', [
//         'institutes' => Institute::latest()->take(3)->get(),
//         'courses' => Courses::latest()->take(3)->get(),
//         'ads' => Advertisements::latest()->take(3)->get(),
//     ]);
// }




}
