<?php
namespace App\Livewire;

use App\Models\Comments;
use Livewire\Component;
use App\Models\CourseAdv;

class CommentCount extends Component
{
    public CourseAdv $courseAdv;
    public Comments $comments;
    public int $count = 0;



    protected $listeners = [
        'set-comment-count' => 'setCount',
        'comment-posted' => 'updateCount',
        'comment-deleted' => 'handleCommentDeleted',
    ];


    public function mount(CourseAdv $courseAdv , Comments $comments)
    {
        $this->courseAdv = $courseAdv;
        $this->updateCount();
    }

    public function updateCount($payload = null)
    {
        if (is_array($payload) && isset($payload['deletedCount'])) {
            $this->count = max(0, $this->count - $payload['deletedCount']);
            return;
        }

        // Fallback to a full DB recount
        $this->count = $this->courseAdv->comments()->count();

    }


    public function setCount($payload = [])
    {
        if (isset($payload['newCount'])) {
            $this->count = $payload['newCount'];
        }
    }
    public function render()
    {
        return view('livewire.comment-count');
    }
}
