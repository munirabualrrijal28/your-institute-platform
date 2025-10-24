<?php

namespace App\Http\Controllers\Institute;

use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Followers;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InstituteMainController extends Controller
{


    
    public function index()
    {
        // return view('institute.dashboard');
        //
        // return view('institute.home.home');

        //
        $institute = Institute::where('user_id_fk', Auth::id())->firstOrFail();

        $followers_count = $institute->followers()->count();

        return view('institute.profile.institute_profile', compact(['institute', 'followers_count']));

    }
    // public function ins_welcome (){
    //     return view('institute.home.homee');


    // }

    public function institute_profile()
    {
        // return view('institute.home.home');
        //

        $institute = Institute::where('user_id_fk', Auth::id())->firstOrFail();
        // dd($institute);
        $followers_count = $institute->followers->count();
        $followers = $institute->followers;
        $ads = $institute->advertisements;

        return view('institute.profile.institute_profile', compact(['institute', 'followers_count', 'followers', 'ads']));


    }



    // public function institute_profile (){
    //     return view('institute.profile.institute_profile');
    //     // return view('institute.dashboard');

    // }

    public function get_ins_id()
    {
        // In your controller or anywhere where you need the user’s institute ID
        $userId = Auth::id();
        // Step 1: Get the current user's ID

        $institute = Institute::where('user_id_fk', $userId)->first();
        // Step 2: Search the institutes table for the user_id_fk matching the current user's ID

        if ($institute) {
            $instituteId = $institute->institute_id; // The institute_id from the found row
            // Step 3: If the institute exists, get the institute_id
            return $instituteId;
        } else {
            // Handle case where no institute is found for the current user
            // For example, show a message or redirect
            $instituteId = null;
            return 1;
        }
        // You can use $instituteId here as needed

    }

    //
    public function ins_profile($id)
    {
        $institute = Institute::with('user')->findOrFail($id);
        $isFollowing = false;

        if (Auth::check() && Auth::user()->role === 3) {        // 3 = student
            $studentId = Auth::user()->student->id;
            $isFollowing = $institute->followers()->where('student_id_fk', $studentId)->exists();
        }

        return view('user.pages.institute_profile', compact('institute', 'isFollowing'));
    }


    // /////////////////////////////

    public function institute_settings()
    {

        $institute = Institute::where('user_id_fk', Auth::id())->firstOrFail();
        $followers_count = $institute->followers->count();
        $followers = $institute->followers;



        $institute = Auth::user()->institute;
        $shouldShowResubmit = $institute && (
            !empty($institute->ins_licence_photo) ||
            !$institute->ins_is_verified ||
            !$institute->is_restricted
        );

        return view('institute.settings.institute_settings', compact(['followers_count', 'institute', 'followers', 'shouldShowResubmit']));

    }



    public function updateInstituteName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        // Update name in users table
        $user->update(['name' => $request->name]);

        // Update name in institutes table
        $institute = Institute::where('user_id_fk', $user->id)->first();
        if ($institute) {
            $institute->update(['ins_name' => $request->name]);

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old profile photo file if it exists
                if ($institute->ins_profile_photo && \Storage::disk('public')->exists($institute->ins_profile_photo)) {
                    Storage::disk('public')->delete($institute->ins_profile_photo);
                }

                // Store new profile photo
                $path = $request->file('photo')->store("media/institutes/{$institute->id}", 'public');

                // Save path to the database
                $institute->update(['ins_profile_photo' => $path]);
            }
        }

        return back()->with('message', 'Institute profile updated successfully.');
    }


    public function updateInstitutePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', '✅ Password updated successfully.');
    }

    public function deleteInstituteAccount(Request $request)
    {
        $request->validate([
            'confirm_password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->confirm_password, $user->password)) {
            return back()->withErrors(['confirm_password' => '❌ Incorrect password']);
        }

        // Delete related institute first (due to foreign key constraint)
        $institute = \App\Models\Institute::where('user_id_fk', $user->id)->first();
        if ($institute) {
            $institute->delete(); // or $institute->forceDelete() if you are not using soft deletes
        }

        // Delete the user
        $user->delete();

        Auth::logout();

        return redirect('/')->with('success', 'Your institute account has been deleted successfully.');
    }



    public function resubmitLicencePhoto(Request $request)
    {
        $request->validate([
            'ins_lic_photo' => ['required', 'image', 'max:2048'],
        ]);

        $user = Auth::user();
        $institute = Institute::where('user_id_fk', $user->id)->first();

        if (!$institute) {
            return back()->withErrors(['message' => 'Institute not found.']);
        }

        // Delete old license photo if it exists
        if ($institute->ins_lic_photo && Storage::disk('public')->exists($institute->ins_lic_photo)) {
            Storage::disk('public')->delete($institute->ins_lic_photo);
        }

        // Upload new license photo
        $path = $request->file('ins_lic_photo')->store("images/ins_profile/{$institute->id}", 'public');

        // Update license photo path in the database
        $institute->update([
            'ins_lic_photo' => $path,
            'ins_lic_photo_approved' => false, // Waiting for admin review
            'is_restricted' => false, // Waiting for admin review
        ]);
        $institute->save();

        // $institute->refresh(); // 🔁 reload fresh values from DB

        // dd($institute->is_restricted);


        // Notify all admins
        $admins = \App\Models\Admin::all();
        foreach ($admins as $admin) {
           $notification = Notifications::create([
                'sender_id' => $user->id,
                'sender_type' => \App\Models\User::class,
                'reciver_id' => $admin->id,
                'reciver_type' => \App\Models\Admin::class,
                'notification_type' => 'licence_resubmitted',
                'data' => [
                    'message' => 'تم إعادة رفع صورة الترخيص من قِبل المعهد: ' . $institute->ins_name,
                ],
            ]);
                event(new NotificationSent($notification));

        }

        return back()->with('message', 'تم رفع صورة الترخيص بنجاح، بانتظار المراجعة.');
    }

}
