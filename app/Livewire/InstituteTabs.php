<?php

namespace App\Livewire;

use Livewire\Component;



class InstituteTabs extends Component
{
    public $activeTab = 'instructors';

    public function render()
    {
        return view('livewire.institute-tabs');
    }
}
