<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CustomerTable extends LivewireDatatable
{
    public $model = Customer::class;

    public function edit($customer)
    {
        $this->emit('edit', $customer);
    }

    public function destroy($id)
    {
        $this->emit('destroy', $id);
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),

            Column::name('name')
                ->label('Name'),

            Column::name('email')
                ->label('Email'),

            Column::name('phone')
                ->label('Phone'),

            Column::name('address')
                ->label('Address'),

            DateColumn::name('date_of_birth')
                ->label('DOB'),


            NumberColumn::name('total_purchase')
                ->label('Total Purchase')
                ->sortBy('total_purchase'),

            DateColumn::name('last_purchase')
                ->label('Last Purchase'),

            DateColumn::name('created_at')
                ->label('Registered On'),


            Column::callback(['id'], function ($id) {

                return "<div class='d-flex justify-content-between action'>
                            <i wire:click='edit({$id})' class='fas fa-edit'></i>
                            <i wire:click='destroy({$id})' class='fas fa-trash text-danger'></i>
                        </div>";
            })->unsortable()->label('Action')->alignCenter()
        ];
    }
}
