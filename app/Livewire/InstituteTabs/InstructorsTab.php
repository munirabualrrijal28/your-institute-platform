<?php
namespace App\Livewire\InstituteTabs;

use Livewire\Component;
use App\Models\Instructors;
use App\Http\Controllers\Controller;

class InstructorsTab extends Component
{
    public $editInstructor = null;

    public function edit($id)
    {
        $this->editInstructor = Instructors::findOrFail($id);
    }

    public function render()
    {
        $instituteId = Controller::getInstituteId();

        return view('livewire.institute-tabs.instructors-tab', [
            'instructors' => Instructors::where('institute_id_fk', $instituteId)->latest()->get(),
            'editInstructor' => $this->editInstructor,
        ]);
    }
}

