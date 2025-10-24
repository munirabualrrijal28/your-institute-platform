<?php

namespace App\Livewire\StudentTabs;

use App\Http\Controllers\Controller;
use App\Models\Advertisements;
use Livewire\Component;
use Livewire\WithPagination;

class AdsTab extends Component
{

    use WithPagination;
 public $instituteId;
    // protected string $pageName = 'adPage'; // 👈 Add this line


    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
    }

    public function render()
    {

         $ads = Advertisements::with(['media', 'comments.user'])
        ->where('institute_id_fk', $this->instituteId)
        ->latest()
        ->paginate(8, pageName: 'adPage');


        return view('livewire.student-tabs.ads-tab', [
            'ads' => $ads
        ]);


    }


}
