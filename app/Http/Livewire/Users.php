<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $user;
    public $editMode = false;

    protected function rules(){
        return [
            'user.name'        => 'required|min:3|max:255',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|string',
            'user.role_id' => 'required|exists:roles,id',
        ];
    }

    protected $messages = [
        'user.name.required' => 'Name is required', 
        'user.name.min' => 'Name length should be atleast 3 characters.', 
        'user.email.required' => 'Email is required.', 
        'user.email.unique' => 'Email is already in use.', 
        'user.password.required' => 'Password is required.', 
        'user.role_id.required' => 'Choose user role.', 
    ];


    public function render()
    {
        return view('livewire.users');
    }

    protected $listeners = ['editUser' => 'editUser'];
 
    public function editUser($id)
    {
        $user = User::find($id);
        $this->editMode = true;
        $this->$user = $user->toArray();

        $this->dispatchBrowserEvent('editUser');
    }

    public function store(){

        $attributes = $this->validate();

        User::create($attributes['user']);

        $this->dispatchBrowserEvent('userAdded', ['message' => 'User added successfully.']);

        $this->emit('refreshLivewireDatatable');
    }
}
