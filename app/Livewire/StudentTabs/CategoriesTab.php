<?php

namespace App\Livewire\StudentTabs;

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
    public function mount($instituteId)
    {
        $this->instituteId = $instituteId;
    }



    public function render()
    {
        $categories = Category::where('institute_id_fk', $this->instituteId)
                  ->latest()
            ->paginate(8,['*'], pageName: 'categoryPage');


        return view('livewire.student-tabs.categories-tab', [
            'categories' => $categories
        ]);
    }
}
