<?php


namespace App\Http\Livewire\Users;


use App\Actions\Fortify\CreateNewUser;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateForm extends Component
{
    public $showForm;

    public $state;

    public function mount()
    {
        $this->state = [
            'name'=>'',
            'email'=>'',
            'password'=>'',
            'password_confirmation'=>''
        ];
    }

    /**
     * Creates a new user
     *
     * @param CreateNewUser $newUser
     */
    public function create(CreateNewUser $newUser)
    {
        $this->resetErrorBag();

        $newUser->create(array_merge($this->state, ['terms'=> true]));

        $this->emit('saved');

        $this->showForm = false;

        \Session::put('success', 'User created successfully');

        redirect()->to(route('users.index'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('users.create-form');
    }
}
