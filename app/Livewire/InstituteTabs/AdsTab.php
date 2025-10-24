<?php

namespace App\Livewire\InstituteTabs;

use App\Events\NotificationSent;
use App\Models\Advertisements;
use App\Models\Comments;
use App\Models\Institute;
use App\Models\Notifications;
use Livewire\Component;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Storage;

class AdsTab extends Component
{

    public $instituteId, $content;

    use WithPagination, WithFileUploads;

    public $images = [];
    public $adId;
    public $editing = false;
    public $formKey;
    public $existingImage = null;

    protected string $paginationTheme = 'tailwind';
    protected string $pageName = 'adPage'; // 👈 Add this line

    //
    //
    public $adPage = 1;
    public $forcePageFlip = false;


    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
    }


    public function render()
    {

        // ✅ Flip pages to force internal Livewire re-mount
        if ($this->forcePageFlip) {
            $this->adPage++;
            $this->forcePageFlip = false;
        }


        $ads = Advertisements::with(['media', 'comments.user'])
            ->where('institute_id_fk', $this->instituteId)
            ->latest()
            ->paginate(8, pageName: 'adPage');

        return view('livewire.institute-tabs.ads-tab', compact('ads'));

    }



    protected $listeners = [
        'confirmDelete' => 'deleteAd'
        ,
        'confirmDeleteAd' => 'deleteAd',
        'deleteConfirmedAd' => 'deleteAd',

        // 'confirmDeleteAd' => 'deleteConfirmedAd'
    ];
    protected $rules = [
        'content' => 'required|string',
        'images.*' => 'nullable|image|max:2048',
    ];



    public function resetForm()
    {
        $this->adId = null;
        $this->content = '';
        $this->images = [];
        $this->existingImage = null;
        $this->editing = false;
        $this->formKey = uniqid();
        $this->resetValidation();
    }

    public function saveAd()
    {

        $institute = Institute::where('id', $this->instituteId)->firstOrFail();

        if (!$institute || !$institute->ins_is_verified || $institute->is_restricted) {
            return session()->flash('error', 'You are not allowed to post. Either unverified or restricted.');
        }


        $this->validate();

        $data = [
            'content' => $this->content,
            'institute_id_fk' => $this->instituteId,
            'user_id' => Auth::id(),
            'user_type' => Auth::user()->role,
        ];



        if ($this->editing && $this->adId) {
            $ad = Advertisements::findOrFail($this->adId);
            $ad->update($data);

            // ✅ Delete existing media (optional: only if new image is provided)
            if (!empty($this->images)) {
                foreach ($ad->media as $media) {
                    Storage::disk('public')->delete($media->url);
                    $media->delete();
                }

                // ✅ Upload new images (whether on create or update)
                if (!empty($this->images)) {
                    foreach ($this->images as $image) {
                        $path = $image->store("ads/{$ad->id}", 'public');

                        Media::create([
                            'mediable_id' => $ad->id,
                            'mediable_type' => Advertisements::class,
                            'url' => $path,
                            'type' => 'image',
                        ]);
                    }
                }
            }
            // $this->resetForm();

            session()->flash('message', 'تم تحديث الإعلان بنجاح');
            $this->resetPage('adPage');
        } else {
            $ad = Advertisements::create($data);

            // ✅ Upload new images (whether on create or update)
            if (!empty($this->images)) {
                foreach ($this->images as $image) {
                    $path = $image->store("ads/{$ad->id}", 'public');

                    Media::create([
                        'mediable_id' => $ad->id,
                        'mediable_type' => Advertisements::class,
                        'url' => $path,
                        'type' => 'image',
                    ]);
                }
            }
            session()->flash('message', 'تمت إضافة إعلان جديد');
            $this->resetPage('adPage');
            // $this->resetForm();
            // $this->forcePageFlip = true;

        }


        /*
        This will now load:

        institute.followers

        for each follower → student

        for each student → user


        */
        $institute = Institute::with('followers.student.user')->find($this->instituteId);
        $followers = $institute->followers;

        foreach ($followers as $follower) {
            $studentUser = optional(optional($follower->student)->user);

            if (!$studentUser || !$studentUser->id)
                continue;

            $notification = Notifications::create([
                'sender_id' => Auth::id(),
                'sender_type' => Institute::class,
                'reciver_id' => $studentUser->id,
                'reciver_type' => \App\Models\User::class,
                'notification_type' => 'new_ad',
                'data' => [
                    'institute_id' => $this->instituteId,
                    'ad_id' => $ad->id,
                    'message' => Auth::user()->name . ' تم إضافة إعلان جديد.'
                ],
                'read_at' => null,
            ]);

            event(new NotificationSent($notification));
        }




        $this->resetForm(); // ✅ Do this FIRST
        $this->resetPage('adPage'); // ✅ Do this AFTER
// return redirect()->route('institute.profile', [

        //     'instituteId' => $this->instituteId,
//     'tab' => 'ads'
// ])->with('message', 'تمت الإضافة');
        // $this->forcePageFlip = true;


    }


    public function editAd($id)
    {
        $institute = Institute::where('id', $this->instituteId)->firstOrFail();

        if (!$institute || !$institute->ins_is_verified || $institute->is_restricted) {
            return session()->flash('error', 'You are not allowed to post. Either unverified or restricted.');
        }
        // dd($id);
        $ad = Advertisements::findOrFail($id);

        $this->adId = $ad->id;
        $this->content = $ad->content;

        $this->images = []; // never prefill with paths

        $this->existingImage = $ad->media->first()?->url;

        $this->editing = true;
        $this->formKey = uniqid();
    }

    // public function render()
    // {
    //     $ads = Advertisements::with('media')
    //         ->where('institute_id_fk', $this->instituteId)
    //         ->latest()
    //         ->paginate(8, pageName: 'adPage');

    //     $categories = Category::where('institute_id_fk', $this->instituteId)->get();

    //     return view('livewire.institute-tabs.ads-tab', compact('ads', 'categories'));
    // }



    public $confirmingDelete = false;
    public $adToDeleteId = null;

    public function confirmDelete($adId)
    {
        $this->confirmingDelete = true;
        $this->adToDeleteId = $adId;
    }

    public function deleteAd()
    {
        Advertisements::findOrFail($this->adToDeleteId)->delete();
        $this->confirmingDelete = false;
        $this->adToDeleteId = null;
        session()->flash('message', 'تم حذف الإعلان بنجاح');




    }


    //
    //
    //

    //////////////////////////////////////////Comments ////////////////////////////////////////////////////


    public $comments = [];
    public $newComments = [];
    public $replyInputs = [];
   public $editingComments = [];
public $commentEditContents = [];

public $editingReplies = [];
public $replyEditContents = [];
    public $expandedCourseId = null;

    public $showReplyInput = [];


    public function loadComments($adId)
    {
        $this->expandedCourseId = $adId;

        $this->comments[$adId] = Comments::with(['user.media', 'replies.user.media'])
            ->where('commentable_id', $adId)
            ->where('commentable_type', Advertisements::class)
            ->whereNull('parent_id')
            ->latest()
            ->get();
    }

    public function addComment($adId, $parentId = null)
    {
        if (!Auth::check()) {
            abort(403, 'Authentication required to post a comment.');
        }

        $content = $parentId ? ($this->replyInputs[$parentId] ?? '') : ($this->newComments[$adId] ?? '');

        $this->validate([
            $parentId ? 'replyInputs.' . $parentId : 'newComments.' . $adId => 'required|string|max:1000',
        ]);

        $comment = Comments::create([
            'content' => $content,
            'user_id_fk' => Auth::id(),
            'commentable_id' => $adId,
            'commentable_type' => Advertisements::class,
            'parent_id' => $parentId,
        ]);

        if ($parentId) {
            $parentComment = Comments::with('user')->find($parentId);
            if ($parentComment && $parentComment->user_id_fk !== Auth::id()) {
                $notification = Notifications::create([
                    'sender_id' => Auth::id(),
                    'sender_type' => Auth::user()::class,
                    'reciver_id' => $parentComment->user->id,
                    'reciver_type' => \App\Models\User::class,
                    'notification_type' => 'comment_reply',
                    'data' => [
                        'ad_id' => $adId,
                        'comment_id' => $comment->id,
                        'message' => Auth::user()->name . ' رد على تعليقك.',
                    ],
                ]);
                event(new NotificationSent($notification));
            }
        }

        $this->loadComments($adId);

        if ($parentId) {
            unset($this->replyInputs[$parentId]);
            unset($this->showReplyInput[$parentId]);

        } else {
            unset($this->newComments[$adId]);
        }



        $content = $parentId
    ? ($this->replyInputs[$parentId] ?? '')
    : ($this->newComments[$adId] ?? '');

    }

public function startEditReply($replyId, $content)
{
    $this->editingReplies[$replyId] = true;
    $this->replyEditContents[$replyId] = $content;
}

  public function updateReply($replyId, $adId)
{
    $this->validate([
        'replyEditContents.' . $replyId => 'required|string|max:1000',
    ]);

    $comment = Comments::findOrFail($replyId);
    if ($comment->user_id_fk === Auth::id()) {
        $comment->content = $this->replyEditContents[$replyId];
        $comment->save();
        $this->dispatch('comment-updated');
    }

    unset($this->editingReplies[$replyId], $this->replyEditContents[$replyId]);
    $this->loadComments($adId);
}
    public function deleteComment($adId, $commentId)
    {
        $comment = Comments::findOrFail($commentId);
        if ($comment->user_id_fk === Auth::id()) {
            $comment->delete();
        }

        $this->loadComments($adId);
    }

    public function deleteReply($replyId, $adId)
    {
        $comment = Comments::findOrFail($replyId);
        if ($comment->user_id_fk === Auth::id()) {
            $comment->delete();
        }

        $this->loadComments($adId);
    }


public function startEditComment($commentId, $content)
{
    $this->editingComments[$commentId] = true;
    $this->commentEditContents[$commentId] = $content;
}

public function updateComment($commentId, $adId)
{
    $this->validate([
        'commentEditContents.' . $commentId => 'required|string|max:1000',
    ]);

    $comment = Comments::findOrFail($commentId);
    if ($comment->user_id_fk === Auth::id()) {
        $comment->content = $this->commentEditContents[$commentId];
        $comment->save();
        $this->dispatch('comment-updated');
    }

    unset($this->editingComments[$commentId], $this->commentEditContents[$commentId]);
    $this->loadComments($adId);
}

public $reportingTarget = null;
public $reportingType = null; // 'comment' or 'reply'
public $reportReason = '';
public $reportDescription = '';
public $showReportModal = false;



public function openReportModal($type, $id)
{
    $this->reportingType = $type;
    $this->reportingTarget = $id;
    $this->reportReason = '';
    $this->reportDescription = '';
    $this->showReportModal = true;
}




public function submitReport()
{
    $this->validate([
        'reportReason' => 'required|string|max:255',
        'reportDescription' => 'nullable|string|max:1000',
    ]);

    \App\Models\Reports::create([
        'user_id_fk' => Auth::id(),
        'reason' => $this->reportReason,
        'description' => $this->reportDescription,
        'reportable_id' => $this->reportingTarget,
        'reportable_type' => \App\Models\Comments::class,
        'status' => 'pending',
    ]);

    $this->reset(['reportingTarget', 'reportingType', 'reportReason', 'reportDescription', 'showReportModal']);

    $this->dispatch('comment-reported');
}






}




