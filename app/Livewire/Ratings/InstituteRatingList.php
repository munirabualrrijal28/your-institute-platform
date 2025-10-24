<?php

namespace App\Livewire\Ratings;

use App\Models\Ratings;
use Livewire\Component;
use Livewire\WithPagination;

class InstituteRatingList extends Component
{
    use WithPagination;

    public $instituteId;

    protected $listeners = [
        'refreshRatings' => '$refresh',
        'ratingDeleted' => '$refresh'
    ];

    public function render()
    {
        $ratings = Ratings::with('user')
            ->where('rated_id', $this->instituteId)
            ->where('type', \App\Models\Institute::class)
            ->whereNotNull('review')
            ->where('is_approved', true)
            ->latest()
            ->paginate(5);

        return view('livewire.ratings.institute-rating-list', [
            'ratings' => $ratings,
        ]);








    }
}
