<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Users extends Component
{
    public $user;
    public $editMode = false;

    protected function rules()
    {
        return [
            'user.name'        => 'required|min:3|max:255',
            'user.email' => ['required', Rule::unique('users', 'email')->ignore($this->user['id'])],
            'user.password' => 'sometimes|required|string',
            'user.role_id' => 'required|exists:roles,id',
        ];
    }
    // protected $messages = [
    //     'user.name.required' => 'Name is required',
    //     'user.name.min' => 'Name length should be atleast 3 characters.',
    //     'user.email.required' => 'Email is required.',
    //     'user.email.unique' => 'Email is already in use.',
    //     'user.password.required' => 'Password is required.',
    //     'user.role_id.required' => 'Choose user role.',
    // ];


    public function render()
    {
        return view('livewire.users');
    }

    protected $listeners = ['editUser' => 'editUser'];

    public function editUser($user)
    {
        $this->editMode = true;
        $this->user = $user;
        $this->dispatchBrowserEvent('editUser');
    }

    public function update()
    {
        $attributes = $this->validate();

        $user = User::find($this->user['id']);


        $update = $user->update($attributes);
        dd($update);
    }

    public function store()
    {

        $attributes = $this->validate();

        User::create($attributes['user']);

        $this->dispatchBrowserEvent('userAdded', ['message' => 'User added successfully.']);

        $this->emit('refreshLivewireDatatable');
    }
}
