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
    public  $categories = [];
    public $image;



    protected $listeners = [
        'edit'    => 'edit',
        'destroy' => 'confirmDelete',
    ];


    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.products.products');
    }

    protected function rules()
    {
        $id = !is_null($this->product) ? $this->product->id : null;

        return [
            'product.code'           => ['required', 'max:255', Rule::unique('products', 'code')->ignore($id)],
            'product.name'           => ['required', 'max:255', Rule::unique('products', 'name')->ignore($id)],
            'product.category_id'    => 'required|exists:categories,id',
            'product.quantity'       => 'required|numeric|gt:0',
            'product.purchase_price' => 'required|gt:0',
            'product.sale_price'     => 'required|gt:product.purchase_price',
            'product.description'    => 'nullable|string',
            'image'                  => 'nullable|image|mimes:jpg,png,webp'
        ];
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
        $this->image = '';
        $this->resetValidation();

        $this->product = $product;
        $this->dispatchBrowserEvent('edit');
    }

    public function update()
    {
        $attributes = $this->validate();

        $this->product->update($attributes['product']);

        if ($this->image) {
            $image = $this->image->store('photos');

            $this->product->update([
                'image' => $image
            ]);
        }


        $this->dispatchBrowserEvent('productAdded', ['message' => 'Product updated successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function confirmDelete(Product $product)
    {

        $this->dispatchBrowserEvent('confirmDelete');
        $this->product = $product;
    }

    public function destroy()
    {

        $this->product->delete();

        $this->dispatchBrowserEvent('productDeleted', ['message' => 'Product deleted successfully.']);

        $this->emit('refreshLivewireDatatable');
    }
}
