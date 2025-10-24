<?php

namespace App\Livewire\InstituteTabs\AdComments;

use App\Models\Advertisements;
use App\Models\Comments;
use Livewire\Component;

class CommentCount extends Component
{

        public Advertisements $ad;
    public Comments $comments;
    public int $count = 0;



    protected $listeners = [
        'set-comment-count' => 'setCount',
        // 'comment-posted' => 'updateCount',
        'comment-deleted' => 'handleCommentDeleted',
    'comment-posted' => 'refreshCount',
    ];


public function setCount($payload)
{
    if (isset($payload['newCount'])) {
        $this->count = $payload['newCount'];
    }
}
public function refreshCount()
{
    // fallback
    $this->count = $this->ad->comments()->count();
}
    public function mount(Advertisements $ad , Comments $comments)
    {
        $this->ad = $ad;
        $this->updateCount();
    }

    public function updateCount($payload = null)
    {
        if (is_array($payload) && isset($payload['deletedCount'])) {
            $this->count = max(0, $this->count - $payload['deletedCount']);
            return;
        }

        // Fallback to a full DB recount
        $this->count = $this->ad->comments()->count();

    }


    // public function setCount($payload = [])
    // {
    //     if (isset($payload['newCount'])) {
    //         $this->count = $payload['newCount'];
    //     }
    // }
    public function render()
    {
        return view('livewire.institute-tabs.ad-comments.comment-count');
    }


    
}
