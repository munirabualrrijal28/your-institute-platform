<?php
namespace App\Livewire\CourseComments;

use App\Models\Courses;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Collection;



class CourseComments extends Component
{

    public $courseId;
    public $commentText = '';
    public $replyText = '';
    public $replyTo = null;

    public function mount($courseId)
    {
        $this->courseId = $courseId;
    }

    public function postComment()
    {
        $this->validate(['commentText' => 'required|string']);

        Comments::create([
            'user_id' => Auth::id(),
            'commentable_id' => $this->courseId,
            'commentable_type' => Courses::class,
            'body' => $this->commentText,
        ]);

        $this->commentText = '';
    }

    public function postReply($parentId)
    {
        $this->validate(['replyText' => 'required|string']);

        Comments::create([
            'user_id' => Auth::id(),
            'commentable_id' => $this->courseId,
            'commentable_type' => Courses::class,
            'parent_id' => $parentId,
            'body' => $this->replyText,
        ]);

        $this->replyText = '';
        $this->replyTo = null;
    }

    public function setReplyTo($commentId)
    {
        $this->replyTo = $commentId;
    }

    public function render()
    {
        $comments = Comments::with('replies', 'user')
            ->where('commentable_type', Courses::class)
            ->where('commentable_id', $this->courseId)
            ->whereNull('parent_id')
            ->latest()
            ->get();

        return view('livewire.course-comments.course-comments', [
            'comments' => $comments,
        ]);
    }



public $editCommentId = null;
public $editedText = '';

public function startEdit($commentId, $currentText)
{
    $this->editCommentId = $commentId;
    $this->editedText = $currentText;
}

public function updateComment()
{
    $this->validate(['editedText' => 'required|string']);

    $comment = Comments::findOrFail($this->editCommentId);

    if ($comment->user_id === Auth::id()) {
        $comment->update(['body' => $this->editedText]);
        $this->editCommentId = null;
        $this->editedText = '';
    }
}

public function cancelEdit()
{
    $this->editCommentId = null;
    $this->editedText = '';
}

public function deleteComment($commentId)
{
    $comment = Comments::findOrFail($commentId);

    if ($comment->user_id === Auth::id()) {
        $comment->replies()->delete(); // optional: delete replies too
        $comment->delete();
    }
}














    // public $comments = [];
    // /** @var Collection $comments */


        // public $courseId;

    //     //
    // public Collection $comments;

    // public $course;
    // public $content = '';
    // public $parentId = null;
    // public array $loadedReplies = [];
    // public array $openReplies = [];

    // public $inputKey;
    // public string $formKey;
    // public ?int $editingId = null;
    // public string $editContent = '';
    // public int $commentCount = 0;

//     protected $rules = [
//         'content' => 'required|string|max:1000',
//     ];


//     protected $listeners = [
//         'comment-deleted' => 'handleCommentDeleted',
//         'refresh-replies' => 'refreshReplies',
//         'comment-posted' => 'refreshComments',

//     ];
//     public function mount($course)
//     {
//         $this->course = $course;
//         $this->commentCount = $course->comments()->count();
//         $this->inputKey = uniqid();
//         $this->formKey = uniqid();

//         $this->refreshComments(); // ✅ Load comments cleanly
//     }

//     public function postComment()
//     {

//         $this->validate([
//             'content' => 'required|string|max:1000',
//         ]);

//         $comment = Comments::create([
//             'content' => $this->content,
//             'user_id_fk' => Auth::id(),
//             'commentable_id' => $this->course->id,
//             'commentable_type' => Courses::class,
//             'parent_id' => $this->parentId,
//         ]);

//         if ($comment->parent_id) {
//             $this->refreshReplies($comment->parent_id);
//         } else {
//             $this->refreshComments();
//         }

//         $this->reset(['content', 'parentId']);
//         $this->formKey = uniqid();
//         $this->inputKey = uniqid();
//         $this->commentCount++; // ✅ increase by 1

//         $this->dispatch('comment-posted');

//     }


//     public function refreshComments()
//     {
//         $this->comments = $this->course->comments()
//             ->with(['user', 'replies.user'])
//             ->whereNull('parent_id')
//             ->latest()
//             ->get();
//     }
//     public function replyTo($commentId)
//     {
//         $this->parentId = $commentId;
//     }


//     public function cancelReply()
//     {
//         $this->reset('content', 'parentId');
//     }

//     public function toggleReplies($commentId)
//     {
//         $this->openReplies[$commentId] = !($this->openReplies[$commentId] ?? false);

//         if (!isset($this->loadedReplies[$commentId])) {
//             $this->refreshReplies($commentId); // ✅ Clean lazy load
//         }
//     }


//     public function refreshReplies($commentId)
//     {
//         $this->loadedReplies[$commentId] = Comments::where('parent_id', $commentId)
//             ->with('user')
//             ->orderBy('created_at')
//             ->get(); // ✅ REMOVE toArray() to preserve Eloquent objects
//     }

//     public function clearInput()
//     {
//         $this->content = '';
//         $this->parentId = null;
//     }

//     //



//     public function handleCommentDeleted($payload)
// {
//     $deletedCount = $payload['deletedCount'] ?? 1;
//     $deletedId = $payload['deletedId'] ?? null;

//     $this->commentCount = max(0, $this->commentCount - $deletedCount);

//     if ($deletedId) {
//         $this->comments = $this->comments->filter(fn($c) => $c->id !== $deletedId);
//         unset($this->loadedReplies[$deletedId], $this->openReplies[$deletedId]);
//     }

//     $this->refreshComments(); // reload from DB just to be safe
// }
//     //
// public function getComments()
// {
//     return $this->course->comments()
//         ->with(['user', 'replies.user'])
//         ->whereNull('parent_id')
//         ->latest()
//         ->get();
// }

    //
// public function render()
// {
// //   $comments = $this->getComments();

// //     return view('livewire.course-comments.course-comments', [
// //         'comments' => $comments,
// //         'commentCount' => $comments->count(),
// //     ]);
//      return view('livewire.course-comments.course-comments', [
//             'comments' => Comments::where('commentable_id', $this->courseId)
//                                   ->where('commentable_type', Courses::class)
//                                   ->whereNull('parent_id')
//                                   ->latest()
//                                   ->get()
//         ]);
// }



}
