<?php

namespace App\Livewire\AdComments;

use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentItem extends Component
{

    public Comments $comment;
    public $showReplyForm = false;
    public $replyContent = '';

    public function postReply()
    {
        $this->validate([
            'replyContent' => 'required|string|max:1000'
        ]);

        $this->comment->replies()->create([
            'content' => $this->replyContent,
            'user_id' => Auth::id(),
        ]);

        $this->replyContent = '';
        $this->showReplyForm = false;

        $this->dispatch('comment-added');
    }

    public function deleteComment()
    {
        $this->comment->delete();
        $this->dispatch('comment-deleted');
    }

    public function render()
    {
        return view('livewire.ad-comments.comment-item');
    }
}
