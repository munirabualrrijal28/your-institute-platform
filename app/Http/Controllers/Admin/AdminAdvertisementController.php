<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertisements;
use App\Models\Institute;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminAdvertisementController extends Controller
{

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'content' => 'required|string|max:1000',
    //         'images.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:20480',
    //     ]);

    //     $ad = Advertisements::create([
    //         'content' => $validated['content'],
    //         'institute_id_fk' => null,
    //         'user_id' => Auth::id(),
    //         'user_type' => '\App\Models\Admin', // or '\App\Models\Admin'
    //     ]);

    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             $path = $image->store("media/advertisements/{$ad->id}", 'public');
    //             Media::create([
    //                 'mediable_id' => $ad->id,
    //                 'mediable_type' => Advertisements::class,
    //                 'url' => $path,
    //                 'type' => $image->getClientOriginalExtension(),
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('message', 'تم نشر الإعلان بنجاح');
    // }


    // public function resetForm()
// {
//     $this->adId = null;
//     $this->content = '';
//     $this->images = [];
//     $this->existingImage = null;
//     $this->editing = false;
//     $this->formKey = uniqid();
// }

    //
    // Remove all public properties related to Livewire
    // public $editing = false;
    // public $adId;
    // ... and so on

    // public function listAds()
    // {
    //     // $ads = Advertisements::withoutGlobalScope('institute_status')
    //     //     ->with('media') // No need for comments.user here for just listing ads
    //     //     ->whereNull('institute_id_fk') // Only admin's global ads
    //     //     ->where('user_type', Admin::class)
    //     //     ->latest()
    //         // ->paginate(8, ['*'], 'adPage');

    //     // return view('admin.ad.manage_ads', compact('ads'));
    //     return view('admin.ad.manage_ads');
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255', // Add title validation
    //         'content' => 'required|string|max:1000',
    //         'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm|max:20480', // Use 'media' not 'images'
    //     ]);

    //     $ad = Advertisements::create([
    //         'title' => $validated['title'], // Store the title
    //         'content' => $validated['content'],
    //         'institute_id_fk' => null, // Explicitly null for admin ads
    //         'user_id' => Auth::id(),
    //         'user_type' => Admin::class, // Use Admin::class directly
    //     ]);

    //    if ($request->hasFile('media')) {
    // foreach ($request->file('media') as $file) {
    //             $path = $file->store("advertisements/{$ad->id}", 'public'); // Store under 'advertisements'
    //             Media::create([
    //                 'mediable_id' => $ad->id,
    //                 'mediable_type' => Advertisements::class,
    //                 'url' => $path,
    //                 'type' => $file->getMimeType(), // Get full mime type
    //             ]);
    //         }
    //     }

    //     return redirect()->route('admin.manage.ads')->with('success', 'Advertisement posted successfully.');
    // }

    // public function updateAd(Request $request, $id)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm|max:20480', // Allow new media upload
    //     ]);

    //     $ad = Advertisements::findOrFail($id);

    //     $ad->update([
    //         'title' => $request->title,
    //         'content' => $request->content,
    //     ]);

    //     // Handle media: If new media is uploaded, you might want to delete old media first.
    //     // For simplicity, this example adds new media without deleting old.
    //     // If you want to replace, you'd delete $ad->media first.
    //     if ($request->hasFile('media')) {
    //         // Option 1: Delete existing media before adding new ones
    //         foreach ($ad->media as $oldMedia) {
    //             Storage::disk('public')->delete($oldMedia->url);
    //             $oldMedia->delete();
    //         }

    //         // Add new media
    //         foreach ($request->file('media') as $file) {
    //             $path = $file->store("advertisements/{$ad->id}", 'public');
    //             $ad->media()->create([
    //                 'url' => $path,
    //                 'type' => $file->getMimeType(),
    //             ]);
    //         }
    //     }

    //     return redirect()->route('admin.manage.ads')->with('success', 'Advertisement updated successfully.');
    // }


    // public function deleteAd($id)
    // {
    //     $ad = Advertisements::findOrFail($id);

    //     // Delete related media files and their records
    //     foreach ($ad->media as $media) {
    //         Storage::disk('public')->delete($media->url); // Delete file from storage
    //         $media->delete(); // Delete media record from database
    //     }

    //     $ad->delete(); // Delete the advertisement record

    //     return redirect()->back()->with('success', 'Advertisement deleted successfully.');
    // }

    // The editAd and resetForm methods from your original controller are not needed
    public function index()
    {
        $advertisements = Advertisements::withoutGlobalScope('institute_status')
            ->with('media') // No need for comments.user here for just listing ads
            ->whereNull('institute_id_fk') // Only admin's global ads
            ->where('user_type', \App\Models\Admin::class)
            ->latest()
            ->paginate(8, pageName: 'adsPage');

        return view('admin.ad.manage_ads', compact('advertisements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255', // ✅ added

            'content' => 'required|string',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $ad = Advertisements::create([
            'title' => $validated['title'], // ✅ added

            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'user_type' => \App\Models\Admin::class,
            'institute_id_fk' => null,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store("ads/{$ad->id}", 'public');
                Media::create([
                    'mediable_id' => $ad->id,
                    'mediable_type' => Advertisements::class,
                    'url' => $path,
                    'type' => 'image',
                ]);
            }
        }

        return redirect()->back()->with('message', 'Advertisement posted successfully.');
    }

    public function destroy($id)
    {
        // dd(Advertisements::withoutGlobalScope('institute_status')->findOrFail($id));
        $ad = Advertisements::withoutGlobalScope('institute_status')->findOrFail($id);
        foreach ($ad->media as $media) {
            Storage::disk('public')->delete($media->url);
            $media->delete();
        }
        $ad->delete();

        return redirect()->back()->with('message', 'Advertisement deleted.');
    }

    public function edit($id)
    {
        $ad = Advertisements::withoutGlobalScope('institute_status')->with('media')->findOrFail($id);
        return view('admin.ad.manage_ads', compact('ad'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $ad = Advertisements::withoutGlobalScope('institute_status')->findOrFail($id);
        $ad->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($ad->media as $media) {
                Storage::disk('public')->delete($media->url);
                $media->delete();
            }

            foreach ($request->file('images') as $img) {
                $path = $img->store("ads/{$ad->id}", 'public');
                Media::create([
                    'mediable_id' => $ad->id,
                    'mediable_type' => Advertisements::class,
                    'url' => $path,
                    'type' => 'image',
                ]);
            }
        }

        // ✅ FIX: redirect back to manage ads view
        // return redirect()->route('admin.manage.ads')->with('message', 'Advertisement updated.');
        return redirect()->back()->with('message', 'Advertisement updated');

    }
}
