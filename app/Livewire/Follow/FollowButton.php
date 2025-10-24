<?php

namespace App\Livewire\Follow;

use App\Events\NotificationSent;
use App\Models\Institute;
use App\Models\Notifications;
use App\Models\Student;
use App\Models\User;
use App\Notifications\NewFollowerNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FollowButton extends Component
{

    public $institute;
    public $isFollowing = false;
    public $followerCount = 0;

    protected $listeners = ['toggleFollow' => 'toggleFollow'];




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
            // ✅ Send notification to the institute's user
            $notification = Notifications::create([
                'sender_id' => $student->id,
                'sender_type' => Student::class,
                'reciver_id' => $this->institute->user->id,
                'reciver_type' => User::class,
                'notification_type' => 'new_follower',
                'data' => [
                    'message' => 'قام الطالب ' . $student->user->name . ' بمتابعتك.',
                ],
                'read_at' => null,
            ]);

            event(new NotificationSent($notification));


        }
    }

    public function render()
    {
        return view('livewire.follow.follow-button');
    }
}
