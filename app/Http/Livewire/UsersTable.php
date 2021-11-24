<?php

namespace App\Http\Livewire;

use App\Models\User;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class UsersTable extends LivewireDatatable
{
    public $model = User::class;

    public function changeStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

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

    public function editPassword($id)
    {
        $this->emit('editPassword', $id);
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

            Column::name('role.name')
                ->label('Role'),

            Column::callback(['id', 'active'], function ($id, $active) {
                $checked = ($active) ? 'checked' : '';
                return "
                <div wire:change='changeStatus({$id})' class='custom-control custom-switch'>
                  <input type='checkbox' class='custom-control-input' id='{$id}' {$checked}>
                  <label class='custom-control-label' for='{$id}'></label>
                </div>";
            })->unsortable()->label('Status'),



            DateColumn::name('created_at')
                ->label('Created at'),

            Column::callback(['id'], function ($id) {

                return "<div class='d-flex justify-content-between action'>
                            <i wire:click='editPassword({$id})' class='fas fa-key'></i>
                            <i wire:click='edit({$id})' class='fas fa-edit'></i>
                            <i wire:click='destroy({$id})' class='fas fa-trash text-danger'></i>
                        </div>";
            })->unsortable()->label('Action')->alignCenter()
        ];
    }
}
