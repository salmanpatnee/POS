<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Products extends Component
{
    public $product;
    public $editMode = false;
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.products.products', compact('categories'));
    }

    protected function rules()
    {
        return [
            'product.code'        => ['required', 'max:255', Rule::unique('products', 'code')],
            'product.name'        => ['required', 'max:255', Rule::unique('products', 'name')],
            'product.category_id' => 'required|exists:categories,name',
            'product.quantity'    => 'required|numeric|gt:0'
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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

        dd($attributes);

        Category::create($attributes['category']);

        $this->dispatchBrowserEvent('categoryAdded', ['message' => 'Category added successfully.']);

        $this->emit('refreshLivewireDatatable');
    }
}
