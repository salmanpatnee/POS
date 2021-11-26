<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CategoriesTable extends LivewireDatatable
{
    public $model = Category::class;

    public function changeStatus(Category $category)
    {
        $category->active = !$category->active;
        $category->save();

        response()->json([], 200);
    }

    public function edit($user)
    {
        $this->emit('edit', $user);
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

            Column::callback(['id', 'active'], function ($id, $active) {
                $checked = ($active) ? 'checked' : '';
                return "
                <div wire:change='changeStatus({$id})' class='custom-control custom-switch'>
                  <input type='checkbox' class='custom-control-input' id='{$id}' {$checked}>
                  <label class='custom-control-label' for='{$id}'></label>
                </div>";
            })->unsortable()->label('Active'),


            Column::callback(['id'], function ($id) {

                return "<div class='d-flex justify-content-around action'>
                            <i wire:click='edit({$id})' class='fas fa-edit'></i>
                            <i wire:click='destroy({$id})' class='fas fa-trash text-danger'></i>
                        </div>";
            })->unsortable()->label('Action')->alignCenter()
        ];
    }
}
