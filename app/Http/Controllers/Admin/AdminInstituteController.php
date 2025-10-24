<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertisements;
use App\Models\Courses;
use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Models\Institute; // Ensure the Institute model is imported
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminInstituteController extends Controller
{

    public function listInstitutes(Request $request)
    {






        $query = Institute::withCount([
            'courses',
            'advertisements',
            'categories',
            'instructors',
            'followers'
        ]);

        if ($request->status === 'verified') {
            $query->where('ins_is_verified', true);
        } elseif ($request->status === 'unverified') {
            $query->where('ins_is_verified', false);
        }

        if ($request->filled('search')) {
            $query->where('ins_name', 'like', '%' . $request->search . '%');
        }

        $institutes = $query->latest()->paginate(10)->withQueryString();


        $active = null;
        if ($request->has('active')) {
            $active = Institute::withCount([
                'courses',
                'advertisements',
                'categories',
                'instructors',
                'followers'
            ])->find($request->active);
        }

        // return view('admin.institute.manage_institutes', [
        //     'unverifiedInstitutes' => Institute::where('ins_is_verified', false)->get(),
        //     'verifiedInstitutes'   => Institute::where('ins_is_verified', true)->get(),
        //     'courses'              => Courses::with(['comments', 'media'])->get(),
        //     'advertisements'       => Advertisements::with(['comments', 'media'])->get()->paginate(10),
        //     'institutes'           => $institutes,
        //     'active'               => $active,
        // ]);
        return view('admin.institute.manage_institutes', [
            'unverifiedInstitutes' => Institute::where('ins_is_verified', false)->paginate(10, ['*'], 'unverifiedPage'),
            'verifiedInstitutes' => Institute::where('ins_is_verified', true)->paginate(10, ['*'], 'verifiedPage'),
            'courses' => Courses::with(['comments', 'media'])->paginate(10, ['*'], 'coursePage'),
            'advertisements' => Advertisements::with(['comments', 'media'])->paginate(8, ['*'], 'adPage'),
            'institutes' => $institutes,
            'active' => $active,
        ]);









    }


    public function rejectProfilePhoto(Institute $institute)
    {
        // Optional: delete old photo
        if ($institute->ins_profile_photo) {
            Storage::disk('public')->delete($institute->ins_profile_photo);
        }

        $institute->update(['ins_profile_photo' => null]);

        // Optional: notify institute here

        return back()->with('message', 'Profile photo rejected and reset.');
    }
    // public function restrictInstitute(Institute $institute)
    // {

    //     Notifications::create([
    //         'sender_id' => Auth::id(),
    //         'sender_type' => Admin::class,
    //         'reciver_id' => $institute->user_id_fk,
    //         'reciver_type' => \App\Models\User::class,
    //         'notification_type' => 'restriction_applied',
    //         'data' => ['message' => 'Your account has been restricted. You can no longer publish content.'],
    //     ]);



    //     return back()->with('message', 'Profile photo rejected and reset.');
    // }


    public function verify($id)
    {
        $institute = Institute::findOrFail($id);
        $institute->update(['ins_is_verified' => true]);
        $institute->ins_is_verified = true;
        $institute->is_restricted = false;
        $institute->save();

        // Notify institute (via user relationship)
        $user = $institute->user;
        $notification = Notifications::create([
            'sender_id' => Auth::id(),
            'sender_type' => Admin::class,
            'reciver_id' => $user->id,
            'reciver_type' => \App\Models\User::class,
            'notification_type' => 'institute_verified',
            'data' => [
                'message' => '🎉 Your institute has been verified! You can now post courses and ads.',
            ],
            // 'data' => json_encode([
            //     'message' => '🎉 Your institute has been verified! You can now post courses and ads.',
            // ]),
        ]);
        event(new NotificationSent($notification));

        return back()->with('success', 'Institute verified and notification sent.');
    }

    public function restrict_ins($id)
    {
        $institute = Institute::findOrFail($id);
        $institute->update(['is_restricted' => true]);
        $institute->ins_is_verified = false;
        $institute->is_restricted = true;
        $institute->save();

        // Notify institute (via user relationship)
        $user = $institute->user;
        $notification = Notifications::create([
            'sender_id' => Auth::id(),
            'sender_type' => Admin::class,
            'reciver_id' => $user->id,
            'reciver_type' => \App\Models\User::class,
            'notification_type' => 'institute_verified',
            'data' => [
                "message' => '🛑❗️❗️❗️ Your institute has been restricted !now You cann't post Courses , Ads , Categories.",
            ],
            // 'data' => json_encode([
            //     'message' => '🎉 Your institute has been verified! You can now post courses and ads.',
            // ]),
        ]);
        event(new NotificationSent($notification));

        return back()->with('success', 'Institute verified and notification sent.');
    }

    // public function restrict($id)
    // {
    //     $institute = Institute::findOrFail($id);
    //     $institute->update(['ins_is_verified' => false]);

    //     // Notify the institute
    //     $user = $institute->user;
    //     Notifications::create([
    //         'sender_id' => Auth::id(),
    //         'sender_type' => Admin::class,
    //         'reciver_id' => $user->id,
    //         'reciver_type' => \App\Models\User::class,
    //         'notification_type' => 'institute_restricted',
    //         'data' => [
    //             'message' => '⚠️ Your institute has been restricted and can no longer post courses or advertisements.',
    //         ],
    //     ]);

    //     return back()->with('success', 'Institute has been restricted and notified.');
    // }



    public function deleteCourse($id)
    {
        $course = Courses::findOrFail($id);
        $course->delete();

        return back()->with('success', 'Course deleted successfully.');
    }
    public function deleteAdvertisement($id)
    {
        $ad = Advertisements::findOrFail($id);
    $ad->delete();

    return back()->with('success', 'Advertisement deleted successfully.');
    }
    public function destroy($id)
    {
        $institute = Institute::findOrFail($id);

        // Optionally delete associated user, courses, ads, etc. if needed
        $institute->delete();

        return back()->with('success', 'Institute deleted successfully.');
    }
public function rejectLicense($id)
{
  $institute = \App\Models\Institute::findOrFail($id);
    $institute->is_restricted = true;
    $institute->save();

    // Find the institute's associated user
    $user = $institute->user;

    // Create notification to the institute user
    Notifications::create([
        'sender_id'     => auth()->guard('admin')->id(), // or Auth::id() if admin is in users
        'sender_type'   => \App\Models\Admin::class,
        'reciver_id'    => $user->id,
        'reciver_type'  => \App\Models\User::class,
        'notification_type' => 'licence_rejected',
        'data' => [
            'message' => 'تم رفض صورة الترخيص الخاصة بك، وقد تم تقييد حسابك حتى يتم إعادة رفع صورة صالحة.',
        ],
    ]);

    $this->restrict_ins($id);

    return redirect()->back()->with('message', 'تم رفض الترخيص وتم إرسال إشعار للمعهد.');
}

}
