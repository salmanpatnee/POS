<?php

namespace App\Http\Livewire\Sales;

use App\Models\Product;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ProductTable extends LivewireDatatable
{
    public $model = Product::class;

    public function columns()
    {
        return [


            Column::name('code')
                ->label('Code'),

            Column::callback(['id', 'image'], function ($id, $image) {
                $image_src = Product::find($id)->getImage();
                return "
                <img class='img-fluid img-thumbnail product-table-thumbnail' src='" . asset($image_src) . "'>";
            })->unsortable()->label('Image'),


            Column::name('name')
                ->label('Name'),


            Column::callback(['id', 'quantity'], function ($id, $quantity) {
                $stock_indication_class = ($quantity <= 10) ? 'danger' : 'info';
                return "
                <span class='badge badge-{$stock_indication_class}'>{$quantity}</span>";
            })->unsortable()->label('Stock'),

            // NumberColumn::name('purchase_price')
            //     ->label('Purchase Price')
            //     ->sortBy('purchase_price'),

            // NumberColumn::name('sale_price')
            //     ->label('Sale Price')
            //     ->sortBy('sale_price'),


            Column::callback(['id'], function ($id) {

                return "<div class='d-flex justify-content-around action'>
                            <button class='btn btn-success'><i class='fas fa-shopping-basket'></i> </button>
                        </div>";
            })->unsortable()->label('Action')->alignCenter()
        ];
    }
}
