<?php

namespace App\Livewire\User\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountTab extends Component
{

  use WithFileUploads;

    public $name;
    public $photo;
    public $showNameEdit = false;
    public $showPhotoUpload = false;

    public function mount()
    {
        $this->name = Auth::user()->name;
    }

    public function getPhotoUrlProperty()
    {
        $media = Auth::user()->media()->where('type', 'profile_photo')->first();

        if ($media) {
            return asset('storage/' . $media->url);
        }

        return asset('/images/profile/user_ic.svg'); // default image
    }

    public function updateName()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Auth::user()->update(['name' => $this->name]);

        $this->showNameEdit = false;
        $this->dispatch('showSuccess');
    }

    public function updatePhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Delete old photo if exists
        $user->media()->where('type', 'profile_photo')->delete();

        // Store new photo
        $path = $this->photo->store("users/{$user->id}", 'public');

        $user->media()->create([
            'url' => $path,
            'type' => 'profile_photo',
        ]);

        $this->showPhotoUpload = false;
        $this->dispatch('showSuccess');
    }

    protected $listeners = [
        'openNameModal' => 'openNameModal',
        'openPhotoModal' => 'openPhotoModal',
    ];

    public function openNameModal()
    {
        $this->showNameEdit = true;
    }

    public function openPhotoModal()
    {
        $this->showPhotoUpload = true;
    }

    public function render()
    {
        return view('livewire.user.settings.account-tab', [
            'photoUrl' => $this->photoUrl,
        ]);
    }
}
