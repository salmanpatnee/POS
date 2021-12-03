<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Categories extends Component
{
    public $category;
    public $editMode = false;

    protected function rules()
    {
        return [
            'category.name' => ['required', 'max:255', Rule::unique('categories', 'name')],
        ];
    }

    protected $messages = [
        'category.name.required' => 'Category name is required.',
        'category.name.unique' => 'Category is already exists.',
    ];

    protected $listeners = [
        'edit'    => 'edit',
        'destroy' => 'confirmDelete',
    ];

    public function render()
    {
        return view('livewire.categories');
    }

    public function create()
    {
        $this->editMode = false;
        $this->resetValidation();
        $this->reset();
        $this->dispatchBrowserEvent('create');
    }

    public function store()
    {
        $attributes = $this->validate();

        Category::create($attributes['category']);

        $this->dispatchBrowserEvent('categoryAdded', ['message' => 'Category added successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Category $category)
    {
        $this->editMode = true;
        $this->resetValidation();

        $this->category = $category;
        $this->dispatchBrowserEvent('edit');
    }

    public function update()
    {
        $attributes = $this->validate([
            'category.name' => ['required', 'max:255', Rule::unique('categories', 'name')->ignore($this->category->id)],
        ]);

        $this->category->update($attributes['category']);

        $this->dispatchBrowserEvent('categoryUpdated', ['message' => 'Category updated successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function confirmDelete(Category $category)
    {
        $this->dispatchBrowserEvent('confirmDelete');
        $this->category = $category;
    }

    public function destroy()
    {

        $this->category->delete();

        $this->dispatchBrowserEvent('categoryDeleted', ['message' => 'Category deleted successfully.']);

        $this->emit('refreshLivewireDatatable');
    }
}
