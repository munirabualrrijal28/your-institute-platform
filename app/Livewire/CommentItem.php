<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseAdv;
class CommentItem extends Component
{
    public Comments $comment;
    public $comments = [];

    public ?string $editContent = null;
    public bool $isEditing = false;
    public bool $confirmingDelete = false;

    public function startEdit()
    {
        if ($this->comment->user_id_fk !== Auth::id())
            return;

        $this->editContent = $this->comment->content;
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editContent = null;
    }

    public function updateComment()
    {
        $this->validate(['editContent' => 'required|string|max:1000']);

        if ($this->comment->user_id_fk !== Auth::id())
            return;

        $this->comment->update(['content' => $this->editContent]);
        $this->cancelEdit();
        $this->dispatch('comment-updated');
    }

    public bool $showDeleteModal = false;

    protected $listeners = ['comment-deleted' => 'updateCount', 'comment-posted' => 'updateCount'];




    public function confirmDelete()
    {
        $this->confirmingDelete = true;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
    }

    // public function deleteComment()
    // {
    //     if ($this->comment->user_id_fk !== Auth::id()) return;

    //     // ✅ Get count of nested replies before deletion
    //     $repliesCount = Comments::where('parent_id', $this->comment->id)->count();
    //     $totalDeleted = 1 + $repliesCount;

    //     $parentId = $this->comment->parent_id;
    //     $this->comment->replies()->delete(); // ✅ delete all replies explicitly
    //     $this->comment->delete();

    //     $this->dispatch('comment-deleted', deletedCount: $totalDeleted);

    //     if ($parentId) {
    //         $this->dispatch('refresh-replies', commentId: $parentId);
    //     }
    //     $this->dispatch('comment-deleted', deletedCount: $totalDeleted, deletedId: $this->comment->id);

    // }



    public function deleteComment()
{

        if (!$this->comment) return;

        $totalDeleted = 1 + $this->comment->replies()->count();

        $this->comment->replies()->delete(); // delete replies first
        $this->comment->delete();

        $this->dispatch('comment-deleted', [
            'deletedCount' => $totalDeleted,
            'deletedId' => $this->comment->id,
        ])->to('course-comments');
        $this->dispatch('comment-deleted', [
            'deletedCount' => $totalDeleted,
            'deletedId' => $this->comment->id,
        ])->to('comment-count');
        $this->dispatch('comment-posted')->to('comment-count'); // for full reload
    }


    public function render()
    {
        return view('livewire.comment-item');
    }

    //


    // 🔄 Reload top-level comments so new ones show immediately
    public function refreshComments()
    {
        $this->comments = $this->courseAdv->comments()
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->get();


    }
    //


}
