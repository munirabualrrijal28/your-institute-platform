<?php

namespace App\Livewire\StudentTabs;

use App\Models\Advertisements;
use App\Models\Category;
use App\Models\Courses;
use App\Models\Followers;
use App\Models\Instructors;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class StudentTabs extends Component
{

    use WithPagination;
    public $instituteId;
    public $formKey;

    // protected $queryString = ['activeTab']; // 👈 this enables query string sync

    public $activeTab = 'instructors';

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;

    }


    public function setTab($tab)
    {
        $this->activeTab = $tab;
        // request()->merge(['activeTab' => $tab]); // This is safe during Livewire updates

        // sync to URL using Livewire 3 redirect helper
        // $this->redirect(request()->url() . '?tab=' . $tab, navigate: true);
    }


    public function render()
    {

        $courses = Courses::where('institute_id_fk', $this->instituteId)->latest()->get();
        $categories = Category::where('institute_id_fk', $this->instituteId)->latest()->get();
        $ads = Advertisements::where('institute_id_fk', $this->instituteId)->latest()->get();
        $instructors = Instructors::where('institute_id_fk', $this->instituteId)->latest()->get();

        return view('livewire.student-tabs.student-tabs', compact('courses', 'categories', 'ads', 'instructors'));



    }


}
