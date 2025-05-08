<?php

namespace App\Livewire\InstituteTabs;

use Livewire\Component;
use App\Models\Courses;
use App\Models\Category;
use App\Http\Controllers\Controller;


class CategoriesTab extends Component
{
 public $editCourse = null;

    public function edit($id)
    {
        $this->editCourse = Category::findOrFail($id);
    }

    public function render()
    {
        $instituteId = Controller::getInstituteId();

        // return view('livewire.institute-tabs.courses-tab', [
        //     'courses' => Courses::with(['category', 'media', 'comments.user'])
        //         ->where('institute_id_fk', $instituteId)->latest()->get(),
        //     'categories' => Category::where('institute_id_fk', $instituteId)->get(),
        //     'editCourse' => $this->editCourse,
        // ]);

        return view('livewire.institute-tabs.categories-tab');

    }
}
