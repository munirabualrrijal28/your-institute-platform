<?php

namespace App\Livewire\Search;

use Livewire\Component;
use App\Models\Institute;
use App\Models\Courses;
use App\Models\Advertisements;

class GlobalSearch extends Component
{

 public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            return;
        }

        $this->results = [
            'institutes' => Institute::where('ins_name', 'like', "%{$this->query}%")->limit(5)->get(),
            'courses'    => Courses::where('course_name', 'like', "%{$this->query}%")
                                   ->orWhere('course_description', 'like', "%{$this->query}%")->limit(5)->get(),
            'ads'        => Advertisements::where('title', 'like', "%{$this->query}%")
                                          ->orWhere('content', 'like', "%{$this->query}%")->limit(5)->get(),
        ];
    }

    public function search()
    {
        if (strlen($this->query) < 2) return;

        return redirect()->route('search.page', ['query' => $this->query]);
    }

    public function render()
    {
        return view('livewire.search.global-search');
    }
}
