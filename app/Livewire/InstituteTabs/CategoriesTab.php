<?php

namespace App\Livewire\InstituteTabs;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class CategoriesTab extends Component
{
    use WithPagination, WithFileUploads;

    public $category_name, $category_des, $category_photo, $categoryId;
    public $editing = false;
    public $formKey;
    public $instituteId;

    protected string $paginationTheme = 'tailwind';
    protected string $pageName = 'categoryPage'; // 👈 Add this line

    protected $listeners = [
        'confirmDelete' => 'deleteCategory'

        ,
        'confirmDeleteCategory' => 'deleteCategory'
    ];
    protected $rules = [
        'category_name' => 'required|string|max:255',
        'category_des' => 'required|string',
        'category_photo' => 'nullable|image|max:2048'
    ];

    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->category_name = '';
        $this->category_des = '';
        $this->category_photo = null;
        $this->categoryId = null;
        $this->editing = false;
        $this->formKey = uniqid(); // 🔁 forces full DOM re-render
        $this->resetValidation();  // ✅ clears validation errors
    }

    public function render()
    {
        $categories = Category::where('institute_id_fk', $this->instituteId)
            ->latest()
            ->paginate(8);

        return view('livewire.institute-tabs.categories-tab', [
            'categories' => $categories
        ]);
    }
    public function saveCategory()
    {

        $this->validate();

        $data = [
            'category_name' => $this->category_name,
            'category_des' => $this->category_des,
            'institute_id_fk' => $this->instituteId,
        ];

        if ($this->category_photo) {
            $data['category_photo'] = $this->category_photo->store("categories/{$this->instituteId}", 'public');
        }

        if ($this->editing && $this->categoryId) {
            Category::findOrFail($this->categoryId)->update($data);
            session()->flash('message', 'تم تحديث الفئة بنجاح');


            $this->resetPage('categoryPage');// 👈 Force reload to page 1

            $this->resetForm();


        } else {
            Category::create($data);
            session()->flash('message', 'تمت إضافة فئة جديدة');


            $this->resetPage('categoryPage');// 👈 Force reload to page 1

        }

        $this->resetForm();

    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);

        $this->categoryId = $category->id;
        $this->category_name = $category->category_name;
        $this->category_des = $category->category_des;
        $this->category_photo = null; // ❗DO NOT assign image path
        $this->editing = true;
        $this->formKey = uniqid();
    }



    //

    #[On('deleteConfirmedCategory')]
    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'تم حذف الفئة بنجاح');
    }



    public function confirmDelete($courseId)
    {
        $this->dispatch('showCategoryDeleteDialog', id: $courseId);
    }


}


//


