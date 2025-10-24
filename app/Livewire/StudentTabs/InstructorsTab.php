<?php

namespace App\Livewire\StudentTabs;

use App\Models\Instructors;
use Livewire\Component;
use Livewire\WithPagination;

class InstructorsTab extends Component
{

    use WithPagination;
    public $instituteId;

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
    }


    public function render()
    {

        $instructors = Instructors::where('institute_id_fk', $this->instituteId)
            ->latest()
            ->paginate(8, ['*'], pageName: 'instructorPage');



        return view('livewire.student-tabs.instructors-tab', [
            'instructors' => $instructors,
        ]);

    }
}
