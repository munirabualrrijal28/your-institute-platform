<?php

namespace App\Livewire\AdComments;

use Livewire\Component;
use App\Models\Advertisements;

class AdComments extends Component
{
    public Advertisements $ad;

    protected $listeners = ['comment-added' => '$refresh', 'comment-deleted' => '$refresh'];

    public function mount(Advertisements $ad)
    {
        $this->ad = $ad;
    }

    public function render()
    {
        $comments = $this->ad->comments()->whereNull('parent_id')->with('user', 'replies.user')->latest()->get();
        return view('livewire.ad-comments.ad-comments', compact('comments'));
    }
}
