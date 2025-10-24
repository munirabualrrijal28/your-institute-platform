<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Advertisements;
use App\Models\Institute;
use App\Models\Notifications;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MasterAdController extends Controller
{
    /**
     * Store a new Advertisement
     */
    public function store_ad(Request $request)
    {
        // Validate Advertisement fields
        $validated = $request->validate([
            'content' => 'nullable|string|max:2000',
        ]);

        // Add required FK fields
        $validated['institute_id_fk'] = Auth::user()->institute->id;
        $validated['user_id'] = Auth::id();
        $validated['user_type'] = Auth::user()->role;
        //
        $userType = Auth::user()->role; // أو $request->user_type
        $userId = Auth::id();

        // خريطة الأنواع إلى الكلاسات
        $modelMap = [
            1 => Admin::class,
            2 => Student::class,
            3 => Institute::class,
        ];

        // تحقق أن النوع موجود
        if (!array_key_exists($userType, $modelMap)) {
            abort(400, 'Invalid user type');
        }

        $modelClass = $modelMap[$userType];
        $ad_published = $modelClass::findOrFail($userId);
        //
        // Create Advertisement
        $ad = Advertisements::create($validated);
        Advertisements::create([
            'content' => $request->content,
            'institute_id_fk' => Controller::getInstituteId(),
            'user_id' => $ad_published->id,
            'user_type' => $modelClass,
        ]);
        // Create folder if not exists
        $folderPath = "advertisements/{$ad->id}";
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        // Upload files
        if ($request->hasFile('ad_files')) {
            foreach ($request->file('ad_files') as $file) {
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs($folderPath, $filename, 'public');

                $ad->media()->create([
                    'url' => "{$folderPath}/{$filename}",
                    'type' => $file->getMimeType()
                ]);
            }
        }

        return redirect()->back()->with('message', 'Advertisement published successfully!');
    }

    // Send notification when advertisement created
    public function notify_student($ad1, $institute)
    {

        $ad = $ad1;

        $followers = $institute->followers; // علاقة مع الطلاب

        foreach ($followers as $student) {
            Notifications::create([
                'sender_id' => $institute->id,
                'sender_type' => Institute::class,
                'reciver_id' => $student->user_id_fk, // نرسل إلى حساب المستخدم
                'reciver_type' => \App\Models\User::class,
                'notification_type' => 'new_advertisement',
                'data' => [
                    'message' => 'تم نشر دورة جديدة من قبل المعهد: ' . $ad->course_name,
                    'course_id' => $ad->id,
                ],
                'read_at' => null,
            ]);

        }
    }





    /**
     * Edit Advertisement - fetch data as JSON
     */
    public function edit_ad($id)
    {
        $ad = Advertisements::findOrFail($id);
        $image = $ad->media()->where('type', 'like', 'image/%')->first();
        return response()->json([
            'ad' => $ad,
            'image_url' => $image ? asset('storage/' . $image->url) : null,
        ]);
    }

    /**
     * Update Advertisement
     */
    public function update_ad(Request $request, $id)
    {
        $ad = Advertisements::findOrFail($id);

        $request->validate([
            'content' => 'nullable|string|max:2000',
            'ad_files.*' => 'nullable|file|mimes:jpeg,png,jpg,mp4,mp3,wav,pdf'
        ]);

        $ad->update([
            'content' => $request->input('content'),
        ]);

        $folderPath = "advertisements/{$ad->id}";
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        // Optional: replace old image
        if ($request->hasFile('ad_files')) {
            foreach ($request->file('ad_files') as $file) {
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs($folderPath, $filename, 'public');

                $ad->media()->create([
                    'url' => "{$folderPath}/{$filename}",
                    'type' => $file->getMimeType()
                ]);
            }
        }

        return redirect()->route('institute.manage_ad')->with('message', 'Advertisement updated successfully!');
    }

    /**
     * Delete Advertisement
     */
    public function delete_ad($id)
    {
        $ad = Advertisements::findOrFail($id);
        $ad->delete();

        return redirect()->back()->with('message', 'Advertisement deleted successfully.');
    }
}
