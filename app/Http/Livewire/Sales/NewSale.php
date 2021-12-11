<?php

namespace App\Http\Livewire\Sales;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Sale;

class NewSale extends Component
{

    public $user;
    public $invoice_id;

    public function mount()
    {
        $this->user = Auth::user()->name;
        $this->invoice_id = $this->generateInvoiceId();
    }

    public function render()
    {
        return view('livewire.sales.new-sale');
    }


    public function createCustomer()
    {
        $this->resetValidation();
        $this->reset();
        $this->dispatchBrowserEvent('create');
    }

    public function generateInvoiceId()
    {
        $latestSale = Sale::orderBy('created_at', 'DESC')->first();
        $invoiceNum = 1;

        if (!is_null($latestSale)) {
            $invoiceNum = $latestSale->id + 1;
        }

        return str_pad($invoiceNum, 8, "0", STR_PAD_LEFT);
    }
}
