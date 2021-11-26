<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Users extends Component
{

    public $user;
    public $password;
    public $password_confirmation;
    public $editMode = false;


    protected function rules()
    {
        return [
            'user.name'     => 'required|min:3|max:255',
            'user.email'    => ['required', Rule::unique('users', 'email')],
            'user.password' => 'string|required',
            'user.role_id'  => 'required|exists:roles,id',
        ];
    }

    protected $messages = [
        'user.name.required'     => 'Name is required.',
        'user.name.min'          => 'Name should be atleast 3 characters.',
        'user.email.required'    => 'Email is required.',
        'user.email.unique'      => 'Email is already in use.',
        'user.password.required' => 'Password is required.',
        'user.role_id.required'  => 'Choose user role.',
    ];

    public function render()
    {
        return view('livewire.users');
    }

    protected $listeners = [
        'edit'         => 'edit',
        'destroy'      => 'confirmDelete',
        'editPassword' => 'editPassword'
    ];


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

        User::create($attributes['user']);

        $this->dispatchBrowserEvent('userAdded', ['message' => 'User added successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function edit(User $user)
    {
        $this->user = $user;

        $this->editMode = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('edit');
    }

    public function update()
    {
        $this->validate([
            'user.name'     => 'required|min:3|max:255',
            'user.email'    => ['required', Rule::unique('users', 'email')->ignore($this->user['id'])],
            'user.role_id'  => 'required|exists:roles,id',
        ]);

        $this->user->update(
            [
                'name'    => $this->user->name,
                'email'   => $this->user->email,
                'role_id' => $this->user->role_id
            ]
        );

        $this->dispatchBrowserEvent('userUpdated', ['message' => 'User updated successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function confirmDelete(User $user)
    {
        $this->user = $user;
        $this->dispatchBrowserEvent('confirmDelete');
    }

    public function destroy()
    {
        $this->user->delete();

        $this->dispatchBrowserEvent('userDeleted', ['message' => 'User deleted successfully.']);

        $this->emit('refreshLivewireDatatable');
    }

    public function editPassword(User $user)
    {
        $this->dispatchBrowserEvent('editPassword');
        $this->user = $user;
    }

    public function changePassword()
    {

        $attribute = $this->validate([
            'password' => 'required|confirmed',
        ]);

        User::where('id', $this->user->id)
            ->update([
                'password' => bcrypt($attribute['password'])
            ]);

        $this->dispatchBrowserEvent('passwordUpdate', ['message' => 'Password updated successfully.']);
    }
}
