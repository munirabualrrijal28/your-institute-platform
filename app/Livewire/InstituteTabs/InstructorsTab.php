<?php
namespace App\Livewire\InstituteTabs;

use Livewire\Component;
use App\Models\Instructors;
use App\Http\Controllers\Controller;
use Livewire\Features\SupportFileUploads\WithFileUploads;


class InstructorsTab extends Component
{
    use WithFileUploads;


    //    public $photo;
    // public $editing = false;
    protected $listeners = [
        'confirmDelete' => 'deleteInstructor'

        ,
        'confirmInstructorDelete' => 'deleteInstructor'
    ];


    public $instituteId;
    // public $formKey;


    // public $instructorForm = [
    //     'id' => null,
    //     'name' => '',
    //     'bio' => '',
    //     'email' => '',
    // ];

    public $instructorId, $name, $bio, $email, $photo;
    public $editing = false;
    public $formKey;

    protected $paginationTheme = 'tailwind'; // ensure Tailwind styling
    protected string $pageName = 'categoryPage'; // 👈 Add this line
    protected function rules()
    {
        return [
            'instructorForm.name' => 'required|string|max:255',
            'instructorForm.bio' => 'required|string|max:500',
            'instructorForm.email' => 'nullable|email|max:255',
            'photo' => 'required|image|max:2048',
        ];
    }



    public function deleteInstructor($id)
    {
        Instructors::findOrFail($id)->delete();
        session()->flash('message', 'تم حذف المدرب بنجاح');


    }


    public function render()
    {


        $instructors = Instructors::where('institute_id_fk', $this->instituteId)
            ->latest()
            ->paginate(6); // 4 cols × 2 rows = 8 cards per page


        return view('livewire.institute-tabs.instructors-tab', [
            'instructors' => $instructors,
        ]);

    }


    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
        $this->resetForm(); // initialize clean
    }

    public function resetForm()
    {
        $this->instructorId = null;
        $this->name = '';
        $this->bio = '';
        $this->email = '';
        $this->photo = null;
        $this->editing = false;
        $this->formKey = uniqid(); // Force full re-render
    }

    public function saveInstructor()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string|max:500',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'bio' => $this->bio,
            'email' => $this->email,
            'institute_id_fk' => $this->instituteId,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store("instructors/{$this->instituteId}", 'public');
        }

        if ($this->editing && $this->instructorId) {
            Instructors::findOrFail($this->instructorId)->update($data);
            session()->flash('message', 'تم تحديث بيانات المدرب بنجاح');
        } else {
            Instructors::create($data);
            session()->flash('message', 'تم إضافة مدرب جديد');
        }

        $this->resetForm();
        $this->dispatch('refreshIcons');

    }


    public function editInstructor($id)
    {
        $instructor = Instructors::findOrFail($id);

        $this->instructorId = $instructor->id;
        $this->name = $instructor->name;
        $this->bio = $instructor->bio;
        $this->email = $instructor->email;
        $this->editing = true;
        $this->photo = null;
        $this->formKey = uniqid(); // re-render inputs with these values


        $this->dispatch('refreshIcons');

    }
}

