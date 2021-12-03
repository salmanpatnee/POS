<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Customers extends Component
{
    public $customer;
    public $editMode = false;

    protected function rules()
    {
        return [
            'customer.name'     => 'required|min:3|max:255',
            'customer.email'    => ['nullable', 'email', Rule::unique('customers', 'email')],
            'customer.phone' => 'string|required',
            'customer.address'  => 'nullable|string',
            'customer.date_of_birth'  => 'required|date',
        ];
    }

    protected $listeners = [
        'edit'         => 'edit',
        'destroy'      => 'confirmDelete',
    ];

    // protected $messages = [
    //     'customer.name.required'     => 'Name is required.',
    //     'customer.name.min'          => 'Name should be atleast 3 characters.',
    //     'customer.email.required'    => 'Email is required.',
    //     'customer.email.unique'      => 'Email is already in use.',
    //     'customer.password.required' => 'Password is required.',
    //     'customer.role_id.required'  => 'Choose customer role.',
    // ];

    public function render()
    {
        return view('livewire.customers.customers');
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

        Customer::create($attributes['customer']);

        $this->dispatchBrowserEvent('customerAdded', ['message' => 'Customer added successfully.']);

        $this->emit('refreshLivewireDatatable');
    }


    public function edit(Customer $customer)
    {
        $this->customer = $customer;

        $this->editMode = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('edit');
    }

    public function update()
    {
        $this->validate([
            'customer.name'     => 'required|min:3|max:255',
            'customer.email'    => ['nullable', 'email', Rule::unique('customers', 'email')->ignore($this->customer->id)],
            'customer.phone' => 'string|required',
            'customer.address'  => 'nullable|string',
            'customer.date_of_birth'  => 'required|date',
        ]);

        $this->customer->update(
            [
                'name'    => $this->customer->name,
                'email'   => $this->customer->email,
                'phone' => $this->customer->phone,
                'address' => $this->customer->address,
                'date_of_birth' => $this->customer->date_of_birth,
            ]
        );

        $this->dispatchBrowserEvent('customerUpdated', ['message' => 'Customer updated successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function confirmDelete(Customer $customer)
    {
        $this->customer = $customer;
        $this->dispatchBrowserEvent('confirmDelete');
    }

    public function destroy()
    {
        $this->customer->delete();

        $this->dispatchBrowserEvent('customerDeleted', ['message' => 'User deleted successfully.']);

        $this->emit('refreshLivewireDatatable');
    }
}
