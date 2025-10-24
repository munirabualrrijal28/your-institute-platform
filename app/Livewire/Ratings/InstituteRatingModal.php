<?php

namespace App\Livewire\Ratings;

use App\Events\NotificationSent;
use App\Models\Admin;
use App\Models\Followers;
use App\Models\Institute;
use App\Models\Notifications;
use App\Models\Ratings;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InstituteRatingModal extends Component
{
    public $instituteId;
    public $existingRatingId = null;
    public $rating = 1;
    public $review = '';
    public $canRate = false;
    public $hasRated = false;
    public $showModal = false;

    protected $listeners = ['open-rating-modal' => 'openModal'];

    public function mount()
    {
        $this->checkPermissions();
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->checkPermissions();
        $this->loadExistingRating();
        $this->showModal = true;
    }

    public function checkPermissions()
    {
        $userId = Auth::id();
        $student = Student::where('user_id_fk', $userId)->first();

        if (!$student) {
            $this->canRate = false;
            return;
        }

        // Check follow relationship
        $this->canRate = Followers::where('student_id_fk', $student->id)
            ->where('institute_id_fk', $this->instituteId)
            ->exists();

        // Check if already rated
        $this->hasRated = Ratings::where('user_id_fk', $userId)
            ->where('rated_id', $this->instituteId)
            ->where('type', \App\Models\Institute::class)
            ->exists();
    }

    public function loadExistingRating()
    {
        $user = Auth::user();
        $existing = Ratings::where('user_id_fk', $user->id)
            ->where('rated_id', $this->instituteId)
            ->where('type', \App\Models\Institute::class)
            ->first();

        $this->existingRatingId = optional($existing)->id;
        $this->rating = optional($existing)->rating ?? 0;
        $this->review = optional($existing)->review ?? '';
    }

    public function save()
    {

        // dd("testing entering save method");
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();
        $student = Student::where('user_id_fk', $userId)->first();






        if (!$student || !$this->canRate) {
            session()->flash('error', 'You must follow this institute to leave a rating.');
            return;
        }


        $cur = Ratings::updateOrCreate(
            [
                'user_id_fk' => $userId,
                'rated_id' => $this->instituteId,
                'type' => Institute::class,
            ],
            [
                'rating' => $this->rating,
                'review' => $this->review,
                'is_approved' => true,
            ]
        );


        // dd($cur);
        // Reload state

        $this->loadExistingRating();
        $this->checkPermissions();

        //
        // Notify all admins
        $admins = Admin::all();
        foreach ($admins as $admin) {
            $notification = Notifications::create([
                'sender_id' => $student->id,
                'sender_type' => \App\Models\Student::class,
                'reciver_id' => $admin->id,
                'reciver_type' => \App\Models\Admin::class,
                'notification_type' => 'rating_submitted',
                'data' => [
                    'message' => "A new rating was submitted for approval.",
                    'rating_id' => $existingRatingId ?? $cur->id,
                    'institute_id' => $this->instituteId,
                ],
            ]);
            event(new NotificationSent($notification));

        }
        //
        // Notify UI

        session()->flash('success', 'Rating submitted.');
        $this->dispatch('refreshRatings')->to('ratings.institute-rating-list');

        $this->dispatchBrowserEvent('notify', ['message' => 'Rating submitted and pending admin approval.']);




    }

    public function deleteRating()
    {



        // Ratings::where('user_id_fk', Auth::id())
        //     ->where('rated_id', $this->instituteId)
        //     ->where('type', \App\Models\Institute::class)
        //     ->delete();

        // $this->reset(['rating', 'review', 'existingRatingId']);
        // $this->hasRated = false;

        // session()->flash('success', 'Rating deleted.');
        // $this->dispatch('refreshRatings')->to('ratings.institute-rating-list');

        //
        if ($this->existingRatingId) {
            Ratings::find($this->existingRatingId)?->delete();

            // Reset all relevant fields
            $this->existingRatingId = null;
            $this->rating = 0;
            $this->review = '';

            // Notify rating list to re-render
            $this->dispatch('ratingDeleted');
            $this->dispatch('refreshRatings')->to('ratings.institute-rating-list');

            session()->flash('message', 'Rating deleted successfully.');
        }

    }

    public function render()
    {


        return view('livewire.ratings.institute-rating-modal');


    }


}

