<?php

namespace App\Livewire\Follow;

use App\Models\Institute;
use App\Notifications\NewFollowerNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FollowButton extends Component
{

    public $institute;
    public $isFollowing = false;
    public $followerCount = 0;

    public function mount(Institute $institute)
    {
        $this->institute = $institute;

        $student = Auth::user()->student;
        if ($student) {
            $this->isFollowing = $student->followedInstitutes()
                ->where('institute_id_fk', $institute->id)
                ->exists();
        }

        $this->followerCount = $institute->followers()->count();
    }

    public function toggleFollow()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return;
        }

        if ($this->isFollowing) {
            $student->followedInstitutes()->detach($this->institute->id);
            $this->isFollowing = false;
            $this->followerCount--;
        } else {
            $student->followedInstitutes()->attach($this->institute->id);
            $this->isFollowing = true;
            $this->followerCount++;

             // ✅ Notify the institute's user
    $this->institute->user->notify(new NewFollowerNotification($student));
        }
    }

    public function render()
    {
        return view('livewire.follow.follow-button');
    }
}
