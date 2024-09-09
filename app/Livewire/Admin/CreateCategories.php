<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Rule;

class CreateCategories extends Component
{

    #[Rule('required')]
    public $addCategory;

    public $category;

    public $selectedCategoryId;

    public function render()
    {
        return view('livewire.admin.create-categories')->layout('components.layouts.admin-layout');
    }

    public function mount() {

        $this->category = Category::all();
    }

    public function save() {

        $this->validate();
        Category::create([
            'name' => $this->addCategory
        ]);
        $this->category = Category::all();

        session()->flash('success', 'Success added category');
    }

    public function delete() {
        $cat = Category::find($this->selectedCategoryId);
        if($cat) {
            $cat->delete();
            $this->category = Category::all();

            session()->flash('delete', 'Success deleted category');
        }
    }
}
