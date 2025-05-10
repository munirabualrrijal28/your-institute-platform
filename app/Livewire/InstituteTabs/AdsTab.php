<?php

namespace App\Livewire\InstituteTabs;

use App\Models\Advertisements;
use Livewire\Component;
use App\Http\Controllers\Controller;

// class AdsTab extends Component
// {
//     public $editAd = null;

//     public function edit($id)
//     {
//         $this->editAd = Advertisements::findOrFail($id);
//     }

//     public function render()
//     {
//         $instituteId = Controller::getInstituteId();

//         return view('livewire.institute-tabs.ads-tab', [
//             'ads' => Advertisements::with(['media', 'comments.user'])
//                 ->where('institute_id_fk', $instituteId)
//                 ->latest()
//                 ->paginate(8),
//             'editAd' => $this->editAd,
//         ]);


//     }



// }


class AdsTab extends Component
{

    public $instituteId, $ads, $content;

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
        $this->loadAds();
    }
    public function loadAds()
    {
        $instituteId = Controller::getInstituteId();

        $this->ads = Advertisements::with(['media', 'comments.user'])
            ->where('institute_id_fk', $instituteId)
            ->latest()
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.institute-tabs.ads-tab');
    }
}
