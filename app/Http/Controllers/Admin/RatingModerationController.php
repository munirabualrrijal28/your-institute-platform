<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Institute;
use App\Models\Notifications;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingModerationController extends Controller
{
 public function index()
    {
        $ratings = Ratings::where('type', 'App\\Models\\Institute')
            ->whereNotNull('review')
            ->where('is_approved', false)
            ->with('user')
            ->latest()
            ->get();

        return view('admin.ratings.index', compact('ratings'));
    }

    public function approve(Ratings $rating)
    {
        $rating->update(['is_approved' => true]);


        // TODO: optionally notify the institute here
          $rating->update(['is_approved' => true]);

    if ($rating->type === Institute::class) {
        $admin = Auth::guard('admin')->user();
        $institute = Institute::find($rating->rated_id);
        $user = $institute->user;

        $notification = Notifications::create([
            'sender_id' => $admin->id,
            'sender_type' => Admin::class,
            'reciver_id' => $user->id,
            'reciver_type' => \App\Models\User::class,
            'notification_type' => 'rating_approved',
            'data' => [
                'message' => 'تمت الموافقة على تقييم جديد لمعهدك من قبل طالب.',
                'rating_id' => $rating->id,
                'student_name' => $rating->user->name,
                'rating' => $rating->rating,
            ],
        ]);

        event(new NotificationSent($notification));
    }

    return redirect()->back()->with('success', 'Rating approved and notification sent.');

        return redirect()->back()->with('success', 'Rating approved successfully.');
    }

    public function reject(Ratings $rating)
    {
        $rating->delete();

        return redirect()->back()->with('success', 'Rating rejected and removed.');
    }}
