<?php

namespace App\Http\Livewire;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class UsersTable extends LivewireDatatable
{
    public $model = User::class;

    public $beforeTableSlot = 'users.addButton';

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->defaultSort('asc')->sortBy('id'),
            Column::name('name')->label('Name')->searchable(),
            Column::name('email')->label('Email')->searchable(),
            Column::name('role.name')->label('Role'),
            BooleanColumn::name('active')->label('Active'),
            DateColumn::name('created_at')->label('Created at'),
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()->label('Actions')
        ];
    }
}
