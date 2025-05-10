<?php











namespace App\Livewire\InstituteTabs;
use App\Models\Category;
use App\Models\Courses;
use App\Models\Instructors;
use App\Models\Advertisements;
use Livewire\Component;
use Livewire\WithFileUploads;



class InstituteTabs extends Component
{
    public $instituteId;
    public $formKey;
    protected $queryString = ['activeTab']; // 👈 this enables query string sync

    public $activeTab = 'instructors';

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
        // $this->activeTab = request()->query('tab', 'instructors'); // fallback to 'instructors'
        $this->formKey = rand();
    }


    public function setTab($tab)
    {
        $this->activeTab = $tab;

        // sync to URL using Livewire 3 redirect helper
        // $this->redirect(request()->url() . '?tab=' . $tab, navigate: true);
    }

    public function render()
    {
        return view('livewire.institute-tabs.institute-tabs');
    }
}
