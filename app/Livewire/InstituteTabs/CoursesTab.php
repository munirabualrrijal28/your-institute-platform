<?php
namespace App\Livewire\InstituteTabs;

use App\Models\Category;
use App\Models\Courses;
use App\Models\Media;
use Livewire\Component;



use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\On;


use Illuminate\Support\Facades\Storage;


class CoursesTab extends Component
{
    use WithPagination, WithFileUploads;

    public $course_name, $course_description, $category_id, $images = [];
    public $courseId;
    public $editing = false;
    public $formKey;
    public $instituteId;
    public $existingImage = null;


    protected $listeners = [
        'confirmDelete' => 'deleteCourse'

        ,
        'confirmDeleteCourse' => 'deleteCourse'
    ];
    protected $rules = [
        'course_name' => 'required|string|max:255',
        'course_description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'images.*' => 'nullable|image|max:2048',
    ];

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
        $this->resetForm();
    }

    public function resetForm()
    {
      $this->courseId = null;
    $this->course_name = '';
    $this->course_description = '';
    $this->category_id = '';
    $this->images = [];
    $this->existingImage = null;
    $this->editing = false;
    $this->formKey = uniqid();
    $this->resetValidation();
    }

    public function saveCourse()
    {
        $this->validate();

        $data = [
            'course_name' => $this->course_name,
            'course_description' => $this->course_description,
            'category_id_fk' => $this->category_id,
            'institute_id_fk' => $this->instituteId,
        ];

        if ($this->editing && $this->courseId) {
            $course = Courses::findOrFail($this->courseId);
            $course->update($data);
            session()->flash('message', 'تم تحديث الدورة بنجاح');
            $this->resetPage('coursePage');// 👈 Force reload to page 1

        } else {
            $course = Courses::create($data);
            session()->flash('message', 'تمت إضافة دورة جديدة');
            $this->resetPage('coursePage');

        }

        // Handle media upload
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $path = $image->store("courses/{$course->id}", 'public');

                Media::create([
                    'mediable_id' => $course->id,
                    'mediable_type' => Courses::class,
                    'url' => $path,
                    'type' => 'image'
                ]);
            }
        }

        $this->resetForm();
    }

    public function editCourse($id)
    {
        $course = Courses::findOrFail($id);

        $this->courseId = $course->id;
        $this->course_name = $course->course_name;
        $this->course_description = $course->course_description;
        $this->category_id = $course->category_id_fk;

        $this->images = []; // never prefill with paths

        $this->existingImage = $course->media->first()?->url;

        $this->editing = true;
        $this->formKey = uniqid();
    }

    public function render()
    {
        $courses = Courses::with('media')
            ->where('institute_id_fk', $this->instituteId)
            ->latest()
            ->paginate(8, pageName: 'coursePage');

        $categories = Category::where('institute_id_fk', $this->instituteId)->get();

        return view('livewire.institute-tabs.courses-tab', compact('courses', 'categories'));
    }


    #[On('deleteConfirmedCourse')]
    public function deleteCourse($id)
    {
        $course = Courses::findOrFail($id);

        // Delete images
        foreach ($course->media as $media) {
            Storage::disk('public')->delete($media->url);
            $media->delete();
        }

        $course->delete();
        session()->flash('message', 'تم حذف الدورة بنجاح');
    }

    public function confirmDelete($courseId)
    {
        $this->dispatch('showCourseDeleteDialog', id: $courseId);
    }


}
