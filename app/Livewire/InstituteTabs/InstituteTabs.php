<?php











namespace App\Livewire\InstituteTabs;
use App\Models\Category;
use App\Models\Courses;
use App\Models\Instructors;
use App\Models\Advertisements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;



class InstituteTabs extends Component
{
    public $instituteId;
    public $formKey;

    // public $activeTab = 'ads';
    public $activeTab = 'instructors';
    // protected $queryString = ['activeTab'];

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
        // No need to manually set activeTab from request, Livewire does it
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.institute-tabs.institute-tabs');
    }





public $newLicencePhoto;

public function resubmitLicencePhoto()
{
    $this->validate([
        'newLicencePhoto' => 'required|image|max:2048',
    ]);

    $institute = Auth::user()->institute;

    if ($institute->ins_licence_photo) {
        Storage::delete($institute->ins_licence_photo);
    }

    $path = $this->newLicencePhoto->store("licences/{$institute->id}", 'public');

    $institute->update([
        'ins_licence_photo' => $path,
        // Still restricted and unverified — await admin
    ]);

    // Optionally notify admin here

    session()->flash('message', 'Your new license photo was submitted. Please wait for admin review.');
}



}
