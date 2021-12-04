<?php

namespace App\Http\Livewire\Sales;

use App\Models\Sale;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SalesTable extends LivewireDatatable
{
    public $model = Sale::class;

    public function columns()
    {
        return [];
    }
}
