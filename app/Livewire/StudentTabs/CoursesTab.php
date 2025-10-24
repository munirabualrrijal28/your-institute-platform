<?php

namespace App\Livewire\StudentTabs;

use App\Models\Category;
use App\Models\Courses;
use Livewire\Component;
use Livewire\WithPagination;

class CoursesTab extends Component
{

use WithPagination;

    public $instituteId;
    protected string $pageName = 'coursePage'; // 👈 Add this line

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
    }


    public function render()
    {
        // $courses = Courses::where('institute_id_fk', $this->instituteId)->latest()->get();
        $categories = Category::where('institute_id_fk', $this->instituteId)->latest()->get();

 $courses = Courses::with('media')
            ->where('institute_id_fk', $this->instituteId)
            ->latest()
            ->paginate(8,['*'], pageName: 'coursePage');


        return view('livewire.student-tabs.courses-tab', compact('courses', 'categories'));

    }
}
