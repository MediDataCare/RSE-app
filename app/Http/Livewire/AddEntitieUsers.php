<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AddEntitieUsers extends Component
{

    public $entitie;
    public $selectedUsers = [];
    public $entitieUsers = [];
    public $allUsers = [];
    public $users = [];

    protected $listeners = [
        'addUser'
    ];

    public function mount()
    {
        $this->users = User::get();
        $this->allUsers = $this->users->filter(function ($item) {
            if (data_get($item, 'data.role', '') === 'user') {
                return $item;
            }
        })->pluck('name', 'id')->toArray();
        $entitie = $this->entitie;
        $this->entitieUsers = $this->users->filter(function ($item) use ($entitie) {
            if (data_get($item, 'data.entitie', '') === $entitie->id) {
                return $item;
            }
        })->pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('frontend.entities.Livewire.add-users-entitie');
    }


    public function addUser()
    {
        $users = $this->users->whereIn('id', $this->selectedUsers);
        if (!empty($this->entitie)) {
            foreach ($users as $user) {
                $data = data_get($user, 'data', []);
                data_set($data, 'entitie', data_get($this->entitie, 'id'));
                $user->update(['data' => $data]);
            }
        }
        $this->dispatchBrowserEvent('reloadPage');
    }

    public function removeUser($id){
        $user = $this->users->where('id', $id)->first();
        $data = data_get($user, 'data', []);
        data_set($data, 'entitie', '');
        $user->update(['data' => $data]);
        $entitie = $this->entitie;
        $this->entitieUsers = $this->users->filter(function ($item) use ($entitie) {
            if (data_get($item, 'data.entitie', '') === $entitie->id) {
                return $item;
            }
        })->pluck('name', 'id')->toArray();
    }
}
