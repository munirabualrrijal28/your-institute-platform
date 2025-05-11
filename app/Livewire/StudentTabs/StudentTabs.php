<?php

namespace App\Livewire\StudentTabs;

use App\Models\Courses;
use App\Models\Followers;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentTabs extends Component
{

      public $activeTab = 'courses';
    public $studentId;

    public function mount()
    {
        $this->studentId = Auth::user()->student->id ?? null;
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $courses = Courses::latest()->paginate(8);
        $following = Followers::with('institute')->where('student_id_fk', $this->studentId)->get();
        $notifications = Notifications::where('notifiable_id', Auth::id())
            ->where('notifiable_type', 'App\Models\User')
            ->latest()
            ->get();

        return view('livewire.student-tabs.student-tabs', [
            'courses' => $courses,
            'following' => $following,
            'notifications' => $notifications,
        ]);
    }
    // public function render()
    // {
    //     return view('livewire.student-tabs.student-tabs');
    // }
}
