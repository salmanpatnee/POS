<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithFileUploads;

    public $product;
    public $editMode = false;
    public $categories = [];
    public $image;

    protected $listeners = [
        'edit'    => 'edit',
        // 'destroy' => 'confirmDelete',
    ];

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
            'product.category_id' => 'required|exists:categories,id',
            'product.quantity'      => 'required|numeric|gt:0',
            'product.purchase_price'    => 'required|numeric|gt:0', 
            'product.sale_price'    => 'required_with:initial_page|numeric|gt:product.purchase_price', 
            'product.description'    => 'nullable|string', 
            'image' => 'required|image|mimes:jpg,png,webp'
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

        $product = Product::create($attributes['product']);

        $image = $this->image->store('photos');

        $product->update([
            'image' => $image
        ]);
        
        $this->dispatchBrowserEvent('productAdded', ['message' => 'Product added successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function edit(Product $product)
    {
        $this->editMode = true;
        $this->resetValidation();

        $this->product = $product;
        $this->dispatchBrowserEvent('edit');
    }
}
