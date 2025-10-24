<?php

namespace App\Livewire\StudentTabs\AdComments;

use App\Events\NewNotificationEvent;
use App\Events\NotificationSent;
use App\Models\Advertisements;
use App\Models\Comments;
use App\Models\Notifications;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdComments extends Component
{


    public Collection $comments;

    public $ad;
    public $content = '';
    public $parentId = null;
    public array $loadedReplies = [];
    public array $openReplies = [];

    public $inputKey;
    public string $formKey;
    public ?int $editingId = null;
    public string $editContent = '';
    public int $commentCount = 0;
    public int $page = 0;

    protected $rules = [
        'content' => 'required|string|max:1000',
    ];


    protected $listeners = [
        'comment-deleted' => 'handleCommentDeleted',
        'refresh-replies' => 'refreshReplies',
        'comment-posted' => 'refreshComments',

    ];
    public function mount($ad)
    {
        $this->ad = $ad;
        $this->commentCount = $ad->comments()->count();
        $this->inputKey = uniqid();
        $this->formKey = uniqid();

        $this->refreshComments(); // ✅ Load comments cleanly
    }

    public function postComment()
    {
        if (!Auth::check()) {
            abort(403, 'Authentication required to post a comment.');
        }

        $this->validate(['content' => 'required|string|max:1000']);

        $comment = Comments::create([
            'content' => $this->content,

            'user_id_fk' => Auth::id(),
            'commentable_id' => $this->ad->id,
            'commentable_type' => Advertisements::class,
            'parent_id' => $this->parentId,
        ]);
        //
//
//
//


        // 🔔 Determine recipient
        if ($this->parentId) {
            $parentComment = Comments::with('user')->find($this->parentId);
            if ($parentComment && $parentComment->user_id_fk !== Auth::id()) {
                $notification = Notifications::create([
                    'sender_id' => Auth::id(),
                    'sender_type' => Student::class,
                    'reciver_id' => $parentComment->user->id, // 💡 Correct user now
                    'reciver_type' => \App\Models\User::class,
                    'notification_type' => 'comment_reply',
                    'data' => [
                        'ad_id' => $this->ad->id,
                        'comment_id' => $comment->id,
                        'message' => Auth::user()->name . ' رد على تعليقك.'
                    ]
                ]);
                // event(new NewNotificationEvent($parentComment->user->id, '🔔 New notification from '.Auth::user()->name));
                event(new NotificationSent($notification));
                // broadcast(new NotificationSent($notification))->toOthers(); // optional: to avoid sending to current user


            }
        } else {
            // It's a top-level comment — notify ad owner
            $instituteUser = $this->ad->institute->user ?? null;

            if ($instituteUser && $instituteUser->id !== Auth::id()) {
                $notification = Notifications::create([
                    'sender_id' => Auth::id(),
                    'sender_type' => Student::class,
                    'reciver_id' => $instituteUser->id,
                    'reciver_type' => \App\Models\User::class,
                    'notification_type' => 'new_comment',
                    'data' => [
                        'ad_id' => $this->ad->id,
                        'comment_id' => $comment->id,
                        'message' => Auth::user()->name . ' علّق على دورتك.'
                    ]
                ]);

                // event(new NewNotificationEvent($instituteUser->id, '🔔 New notification from '.Auth::user()->name));
                event(new NotificationSent($notification));
                // broadcast(new NotificationSent($notification))->toOthers(); // optional: to avoid sending to current user

            }

        }




        //
//
//
//

        // Refresh comments
        $this->refreshComments();

        // Notify Livewire count updater
        $newCount = $this->ad->comments()->count();
        $this->dispatch('set-comment-count', ['newCount' => $newCount])->to('student-tabs.ad-comments.comment-count');

        $this->reset(['content', 'parentId']);
        $this->formKey = uniqid();

    }


    public function refreshComments()
    {
        $this->comments = $this->ad->comments()
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->get();
    }
    public function replyTo($commentId)
    {
        $this->parentId = $commentId;
    }


    public function cancelReply()
    {
        $this->reset('content', 'parentId');
    }

    public function toggleReplies($commentId)
    {
        $this->openReplies[$commentId] = !($this->openReplies[$commentId] ?? false);

        if (!isset($this->loadedReplies[$commentId])) {
            $this->refreshReplies($commentId); // ✅ Clean lazy load
        }
    }


    public function refreshReplies($commentId)
    {
        $this->loadedReplies[$commentId] = Comments::where('parent_id', $commentId)
            ->with('user')
            ->orderBy('created_at')
            ->get(); // ✅ REMOVE toArray() to preserve Eloquent objects
    }

    public function clearInput()
    {
        $this->content = '';
        $this->parentId = null;
    }

    //


    public function handleCommentDeleted($payload)
    {
        $deletedCount = $payload['deletedCount'] ?? 1;
        $deletedId = $payload['deletedId'] ?? null;

        // Update internal tracking
        $this->commentCount = max(0, $this->commentCount - $deletedCount);

        if ($deletedId) {
            $this->comments = $this->comments->filter(fn($c) => $c->id !== $deletedId);
            unset($this->loadedReplies[$deletedId], $this->openReplies[$deletedId]);
        }

        $this->refreshComments(); // ✅ reload from DB
    }

    public function getComments()
    {
        return $this->ad->comments()
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->get();
    }

    //
    public function render()
    {
        $comments = $this->getComments();

        return view('livewire.student-tabs.ad-comments.ad-comments', [
            'comments' => $comments,
            'commentCount' => $comments->count(),
        ]);
    }



    //

    public function loadMore()
    {
        $this->page++;
    }

}
