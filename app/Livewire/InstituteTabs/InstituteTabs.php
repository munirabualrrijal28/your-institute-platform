<?php



namespace App\Livewire\InstituteTabs;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Courses;
use App\Models\Instructors;
use Livewire\Component;

use App\Models\Advertisements;

// class InstituteTabs extends Component
// {

//     public $activeTab = 'instructors';
//  public   $tab_page = '';
//  protected $queryString = ['activeTab'];


//     public function mount()
//     {
//         $this->activeTab = request()->get('activeTab', 'instructors');
//     }

//     public function setTab($tab)
//     {
//         // dd($tab);
//         $this->tab_page = $tab ;
//         $this->activeTab = $tab;

//     }

//     //
//     public function getCategoriesProperty()
//     {
//         if ($this->activeTab === 'categories') {
//             return Category::where('institute_id_fk', Controller::getInstituteId())->paginate(8);
//         }
//         return collect(); // empty collection when not needed
//     }
//     //
//     public function getCoursesProperty()
//     {
//         if ($this->activeTab === 'courses') {
//             $ins_id = Controller::getInstituteId();
//             return Courses::with(['category', 'media', 'comments.user'])
//                 ->where('institute_id_fk', $ins_id)
//                 ->latest()
//                 ->paginate(8);
//         }
//         return collect(); // empty collection when not needed
//     }

//     //
//     public function getInstructorsProperty()
//     {
//         if ($this->activeTab === 'instructors') {
//             $ins_id = Controller::getInstituteId();
//             return Instructors::with(['category', 'media', 'comments.user'])
//                 ->where('institute_id_fk', $ins_id)
//                 ->latest()
//                 ->paginate(8);
//         }
//         return collect(); // empty collection when not needed
//     }

//     //
//     //
//     //
//     //
//     //
//     //

//     // public function render()
//     // {
//     //     if($this->activeTab == 'categories'){
//     //         $categories = Category::where('institute_id_fk' , Controller::getInstituteId())->paginate(8);
//     //     return view('livewire.institute-tabs.institute-tabs', compact ('categories'));
//     //     }elseif($this->activeTab == 'courses'){
//     //         $ins_id = Controller::getInstituteId();

//     //         $categories = Category::where('institute_id_fk', $ins_id)->get();

//     //         $courses = Courses::with([
//     //             'category',
//     //             'media',
//     //             'comments.user'
//     //         ])
//     //         ->where('institute_id_fk', $ins_id)
//     //         ->latest()
//     //         ->paginate(8);

//     //         $editCourse = null;
//     //         // if ($request->has('edit_id')) {
//     //         //     $editCourseAdv = Courses::find($request->edit_id);
//     //         // }
//     //         return view('livewire.institute-tabs.institute-tabs' , compact('categories', 'courses', 'editCourse'));
//     //     }else{
//     //         return view('livewire.institute-tabs.institute-tabs' );
//     //     }
//     // }
//     public function render()
//     {
//         $categories = collect();
//         $courses = collect();

//         if ($this->activeTab === 'categories') {
//             $categories = Category::where('institute_id_fk', Controller::getInstituteId())->paginate(8);
//         }

//         if ($this->activeTab === 'courses') {
//             $ins_id = Controller::getInstituteId();
//             $categories = Category::where('institute_id_fk', $ins_id)->get();
//             $courses = Courses::with(['category', 'media', 'comments.user'])
//                 ->where('institute_id_fk', $ins_id)
//                 ->latest()
//                 ->paginate(8);
//         }

//         return view('livewire.institute-tabs.institute-tabs', compact('categories', 'courses'));
//     }
// }






// class InstituteTabs extends Component
// {
//     public $activeTab = 'instructors';

//     public $editInstructor = null;
//     public $editCourse = null;
//     public $editCategory = null;
//     public $editAd = null;

//     protected $queryString = ['activeTab'];

//     public function mount()
//     {
//         $this->activeTab = request()->get('activeTab', 'instructors');
//     }

//     // Edit methods...
//     public function editInstructor($id)
//     {
//         $this->editInstructor = Instructors::findOrFail($id);
//         $this->activeTab = 'instructors';
//     }

//     public function editCourse($id)
//     {
//         $this->editCourse = Courses::findOrFail($id);
//         $this->activeTab = 'courses';
//     }

//     public function editCategory($id)
//     {
//         $this->editCategory = Category::findOrFail($id);
//         $this->activeTab = 'categories';
//     }

//     public function editAd($id)
//     {
//         $this->editAd = Advertisements::findOrFail($id);
//         $this->activeTab = 'ads';
//     }

//     public function render()
//     {
//         $instituteId = Controller::getInstituteId();

//         // ✅ Always define everything
//         $instructors = Instructors::where('institute_id_fk', $instituteId)->latest()->get();
//         $categories = Category::where('institute_id_fk', $instituteId)->get();
//         $courses = Courses::with(['category', 'media', 'comments.user'])
//             ->where('institute_id_fk', $instituteId)->latest()->get();
//         $ads = Advertisements::where('institute_id_fk', $instituteId)->latest()->get();

//         return view('livewire.institute-tabs.institute-tabs', [
//             'instructors' => $instructors,
//             'categories' => $categories,
//             'courses' => $courses,
//             'ads' => $ads,
//             'editInstructor' => $this->editInstructor,
//             'editCourse' => $this->editCourse,
//             'editCategory' => $this->editCategory,
//             'editAd' => $this->editAd,
//         ]);
//     }
// }

class InstituteTabs extends Component
{
    public $activeTab = 'instructors';

    public function render()
    {
        return view('livewire.institute-tabs');
    }
}
