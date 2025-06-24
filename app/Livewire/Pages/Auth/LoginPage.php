<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

#[Layout('layouts.guest')]
class LoginPage extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|min:8')]
    public string $password = '';

    public bool $remember = false;

    public function login(): mixed
    {
        $this->validate();

        if (Auth::attempt(
            ['email' => $this->email, 'password' => $this->password],
            $this->remember
        )) {
            Session::regenerate();

            $target = session()->pull('url.intended', route('dataperkuliahan'));
            return $this->redirect($target, navigate: true);
        }

        $this->addError('email', 'Email atau password salah');
    }

    public function render(): mixed
    {
        return view('livewire.pages.auth.login-page');
    }
}
