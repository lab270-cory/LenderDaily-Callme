<?php

namespace App\Http\Livewire\Users;

use App\Actions\Fortify\ResetPassword;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ResetPasswordForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'password' => '',
        'password_confirmation' => '',
    ];

    /**
     * User whose profile is getting changed
     *
     * @var
     */
    public $user;

    /**
     * Resets the user's password.
     *
     * @param ResetUserPassword  $updater
     * @return void
     */
    public function updatePassword(ResetUserPassword $updater)
    {
        $this->resetErrorBag();

        $updater->reset($this->user, $this->state);

        $this->state = [
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->emit('saved');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return $this->user;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function render()
    {
        return view('users.reset-password-form');
    }
}
