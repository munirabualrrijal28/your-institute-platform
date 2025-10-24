<?php
namespace App\Livewire\InstituteTabs;

use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Courses;
use App\Models\Institute;
use App\Models\Media;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\On;


use Illuminate\Support\Facades\Storage;


class CoursesTab extends Component
{
    use WithPagination, WithFileUploads;

    public $course_name, $course_description, $category_id, $images = [];
    public $courseId;
    public $editing = false;
    public $formKey;
    public $instituteId;
    public $existingImage = null;


    public $blocked;

    protected $listeners = [
        'confirmDelete' => 'deleteCourse'

        ,
        'confirmDeleteCourse' => 'deleteConfirmedCourse',
        'comment-deleted' => 'handleCommentDeleted',
        'refresh-replies' => 'refreshReplies',
        'comment-posted' => 'refreshComments',
    ];
    protected $rules = [
        'course_name' => 'required|string|max:255',
        'course_description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'images.*' => 'nullable|image|max:2048',
    ];

    public function mount($instituteId)
    {
        $user = Auth::user();
        $institute = Institute::where('id', $instituteId)->first();

        $this->blocked = !$institute || !$institute->ins_is_verified || $institute->is_restricted;
        $this->instituteId = $instituteId;
        // $this->formKey = uniqid(); // Triggers DOM re-init safely

        // $this->resetForm();
    }




    public function resetForm()
    {
        $this->courseId = null;
        $this->course_name = '';
        $this->course_description = '';
        $this->category_id = '';
        $this->images = [];
        $this->existingImage = null;
        $this->editing = false;
        $this->formKey = uniqid();
        $this->resetValidation();
    }

    public function saveCourse()
    {

        $institute = Institute::where('id', $this->instituteId)->firstOrFail();

        if (!$institute || !$institute->ins_is_verified || $institute->is_restricted) {
            return session()->flash('error', 'You are not allowed to post. Either unverified or restricted.');
        }






        $this->validate();

        $data = [
            'course_name' => $this->course_name,
            'course_description' => $this->course_description,
            'category_id_fk' => $this->category_id,
            'institute_id_fk' => $this->instituteId,
        ];

        if ($this->editing && $this->courseId) {
            $course = Courses::findOrFail($this->courseId);
            $course->update($data);
            session()->flash('message', 'تم تحديث الدورة بنجاح');
            $this->resetPage('coursePage');// 👈 Force reload to page 1

        } else {
            $course = Courses::create($data);
            session()->flash('message', 'تمت إضافة دورة جديدة');
            $this->resetPage('coursePage');

        }

        // Handle media upload
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $path = $image->store("courses/{$course->id}", 'public');

                Media::create([
                    'mediable_id' => $course->id,
                    'mediable_type' => Courses::class,
                    'url' => $path,
                    'type' => 'image'
                ]);
            }
        }



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
                'notification_type' => 'new_course',
                'data' => [
                    'institute_id' => $this->instituteId,
                    'course_id' => $course->id,
                    'message' => Auth::user()->name . ' تم إضافة دورة جديدة.'
                ],
                'read_at' => null,
            ]);

            event(new NotificationSent($notification));
        }

        // Handle existing image

        $this->resetCourseForm(); // reset inputs
        $this->formKey = rand(); // regenerate to force re-render
        $this->resetForm();
        // $this->dispatch('courseAdded'); // optional, for events

    }

    public function editCourse($id)
    {


        $institute = Institute::where('id', $this->instituteId)->firstOrFail();

        if (!$institute || !$institute->ins_is_verified || $institute->is_restricted) {
            return session()->flash('error', 'You are not allowed to post. Either unverified or restricted.');
        }





        // dd($id);
        $course = Courses::findOrFail($id);

        $this->courseId = $course->id;
        $this->course_name = $course->course_name;
        $this->course_description = $course->course_description;
        $this->category_id = $course->category_id_fk;

        $this->images = []; // never prefill with paths

        $this->existingImage = $course->media->first()?->url;

        $this->editing = true;
        $this->formKey = uniqid();
    }

    public function resetCourseForm()
    {
        $this->reset(['course_name', 'course_description', 'category_id', 'images', 'existingImage', 'editing', 'courseId']);
        $this->formKey = uniqid();
    }
    public function render()
    {

        $courses = Courses::with('comments.user.media')
            ->where('institute_id_fk', $this->instituteId)
            ->latest()
            ->paginate(8, ['*'], pageName: 'coursePage');


        $categories = Category::where('institute_id_fk', $this->instituteId)->get();

        // return view('livewire.institute-tabs.courses-tab', compact('courses', 'categories'));
        return view('livewire.institute-tabs.courses-tab', [
            'courses' => $courses,
            'categories' => $categories // Existing logic
        ]);


    }



    //
    public $confirmingDelete = false;
    public $courseToDeleteId = null;

    public function confirmDelete($courseId)
    {
        $this->confirmingDelete = true;
        $this->courseToDeleteId = $courseId;
    }

    public function deleteCourse()
    {
        Courses::findOrFail($this->courseToDeleteId)->delete();
        $this->confirmingDelete = false;
        $this->courseToDeleteId = null;
        session()->flash('message', 'تم حذف الدورة بنجاح');
    }

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


    public function loadComments($courseId)
    {
        // $this->expandedCourseId = $courseId;

        // $this->comments[$courseId] = Comments::with(['user.media', 'replies.user.media'])
        //     ->where('commentable_id', $courseId)
        //     ->where('commentable_type', Courses::class)
        //     ->whereNull('parent_id')
        //     ->latest()
        //     ->get();
        $this->expandedCourseId = $courseId;

        $comments = Comments::with(['user.media', 'replies.user.media'])
            ->where('commentable_id', $courseId)
            ->where('commentable_type', Courses::class)
            ->whereNull('parent_id')
            ->latest()
            ->get();

        $this->comments[$courseId] = $comments;

        // ✅ Safely reset related state after reload
        foreach ($comments as $comment) {
            $this->replyInputs[$comment->id] ??= '';
            $this->editingReplies[$comment->id] ??= false;
            $this->replyEditContents[$comment->id] ??= '';

            foreach ($comment->replies as $reply) {
                $this->editingReplies[$reply->id] ??= false;
                $this->replyEditContents[$reply->id] ??= '';
            }
        }



    }

    public function addComment($courseId, $parentId = null)
    {
        if (!Auth::check()) {
            abort(403, 'Authentication required to post a comment.');
        }

        $content = $parentId ? ($this->replyInputs[$parentId] ?? '') : ($this->newComments[$courseId] ?? '');

        $this->validate([
            $parentId ? 'replyInputs.' . $parentId : 'newComments.' . $courseId => 'required|string|max:1000',
        ]);

        $comment = Comments::create([
            'content' => $content,
            'user_id_fk' => Auth::id(),
            'commentable_id' => $courseId,
            'commentable_type' => Courses::class,
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
                        'course_id' => $courseId,
                        'comment_id' => $comment->id,
                        'message' => Auth::user()->name . ' رد على تعليقك.',
                    ],
                ]);
                event(new NotificationSent($notification));
            }
        }

        $this->loadComments($courseId);

        if ($parentId) {
            unset($this->replyInputs[$parentId]);
            unset($this->showReplyInput[$parentId]);

        } else {
            unset($this->newComments[$courseId]);
        }
        $content = $parentId
            ? ($this->replyInputs[$parentId] ?? '')
            : ($this->newComments[$courseId] ?? '');

    }

    public function startEditReply($replyId, $content)
    {
        $this->editingReplies[$replyId] = true;
        $this->replyEditContents[$replyId] = $content;
    }

    public function updateReply($replyId, $courseId)
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
        $this->loadComments($courseId);
    }
    public function deleteComment($courseId, $commentId)
    {
        $comment = Comments::findOrFail($commentId);
        if ($comment->user_id_fk === Auth::id()) {
            $comment->delete();
        }

        $this->loadComments($courseId);
    }

    public function deleteReply($replyId, $courseId)
    {
        $comment = Comments::findOrFail($replyId);
        if ($comment->user_id_fk === Auth::id()) {
            $comment->delete();
        }

        $this->loadComments($courseId);
    }

    // public function render()
    // {

    // }
    public function startEditComment($commentId, $content)
    {
        $this->editingComments[$commentId] = true;
        $this->commentEditContents[$commentId] = $content;
    }

    public function updateComment($commentId, $courseId)
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
        $this->loadComments($courseId);
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
