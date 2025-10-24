<?php

namespace App\Livewire\User\Settings;

use App\Models\Followers;
use App\Models\Institute;
use Livewire\Component;

class FollowingTab extends Component
{


     public $studentId;
    public $followedInstitutes;

    public function mount($studentId)
    {

        $this->studentId = $studentId;
        $this->loadFollowedInstitutes();
        
    }

    public function loadFollowedInstitutes()
    {

        $this->followedInstitutes = Institute::whereIn('id', function ($query) {
            $query->select('institute_id_fk')
                ->from('followers')
                ->where('student_id_fk', $this->studentId);
        })->get();

    }

    public function unfollow($instituteId)
    {

        Followers::where('student_id_fk', $this->studentId)
            ->where('institute_id_fk', $instituteId)
            ->delete();

        $this->loadFollowedInstitutes();

    }

    public function render()
    {
        return view('livewire.user.settings.following-tab');
    }

}
