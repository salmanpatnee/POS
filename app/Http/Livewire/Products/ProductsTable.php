<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ProductsTable extends LivewireDatatable
{
    public $model = Product::class;

    public function edit($user)
    {
        $this->emit('edit', $user);
    }
    
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),

            Column::name('code')
                ->label('Code'),

            Column::callback(['id', 'image'], function ($id, $image) {
                $image_src = Product::find($id)->getImage();
                // $stock_indication_class = ($quantity <= 10) ? 'danger' : 'info';
                return "
                <img class='img-fluid img-thumbnail product-table-thumbnail' src='".asset($image_src)."'>";
            })->unsortable()->label('Image'),

            // Column::name('image')
            //     ->label('Image'),

            Column::name('name')
                ->label('Name'),

            Column::name('category.name')
                ->label('Category')
                ->filterable($this->category)->alignRight(),


            Column::callback(['id', 'quantity'], function ($id, $quantity) {
                $stock_indication_class = ($quantity <= 10) ? 'danger' : 'info';
                return "
                <span class='badge badge-{$stock_indication_class}'>{$quantity}</span>";
            })->unsortable()->label('Qty'),

            NumberColumn::name('purchase_price')
                ->label('Purchase Price')
                ->sortBy('purchase_price'),

            NumberColumn::name('sale_price')
                ->label('Sale Price')
                ->sortBy('sale_price'),


            Column::callback(['id'], function ($id) {

                return "<div class='d-flex justify-content-around action'>
                            <i wire:click='edit({$id})' class='fas fa-edit'></i>
                            <i wire:click='destroy({$id})' class='fas fa-trash text-danger'></i>
                        </div>";
            })->unsortable()->label('Action')->alignCenter()
        ];
    }
    public function getCategoryProperty()
    {
        return Category::pluck('name');
    }
}
