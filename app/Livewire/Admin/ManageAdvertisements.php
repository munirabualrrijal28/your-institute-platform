<?php

namespace App\Livewire\Admin;



use App\Models\Admin;
use App\Models\Advertisements;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageAdvertisements extends Component
{


       use WithPagination, WithFileUploads;

    public $title;
    public $content;
    public $images = [];
    public $existingImage;
    public $editing = false;
    public $adId;


    public $confirmingDelete = false;
    public $adToDeleteId;
    public $formKey;


    protected string $paginationTheme = 'tailwind';
    protected string $pageName = 'adsPage'; // 👈 Add this line
    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'images.*' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->formKey = uniqid();
    }

    public function render()
    {

        $ads = Advertisements::withoutGlobalScope('institute_status')
            ->with('media') // No need for comments.user here for just listing ads
            ->whereNull('institute_id_fk') // Only admin's global ads
            ->where('user_type', \App\Models\Admin::class)
            ->latest()
            ->paginate(8, pageName: 'adsPage');

        return view('livewire.admin.manage-advertisements' , compact('ads'));
    }

    public function saveAd()
    {

        dd("testing entering saveAd method");
        $this->validate();

        $ad = Advertisements::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_type' => Admin::class,
            'user_id' => Auth::id(),
            'institute_id_fk' => null, // Assuming this is a global ad
        ]);

        if ($this->images) {
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

        session()->flash('message', 'تمت إضافة الإعلان بنجاح.');
        $this->resetForm();
    }

    public function editAd($id)
    {
        $ad = Advertisements::with('media')->findOrFail($id);
        $this->adId = $ad->id;
        $this->title = $ad->title;
        $this->content = $ad->content;
        $this->editing = true;
        $this->existingImage = optional($ad->media->first())->url;
        $this->formKey = uniqid();
    }

    public function updateAd()
    {
        $this->validate();

        $ad = Advertisements::findOrFail($this->adId);
        $ad->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        if ($this->images) {
            // Delete old media
            foreach ($ad->media as $media) {
                Storage::disk('public')->delete($media->url);
                $media->delete();
            }
            // Upload new ones
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

        session()->flash('message', 'تم تعديل الإعلان بنجاح.');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->adToDeleteId = $id;
    }

    public function deleteAd($id)
    {
        $ad = Advertisements::findOrFail($id);

        foreach ($ad->media as $media) {
            Storage::disk('public')->delete($media->url);
            $media->delete();
        }

        $ad->delete();
        $this->confirmingDelete = false;
        session()->flash('message', 'تم حذف الإعلان بنجاح.');
    }

    public function resetForm()
    {
        $this->adId = null;
        $this->title = '';
        $this->content = '';
        $this->images = [];
        $this->existingImage = null;
        $this->editing = false;
        $this->formKey = uniqid();
        $this->resetValidation();
    }

}




