<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Notifications\AdminEmailVerification;
use Illuminate\Support\Facades\Notification;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $something;
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

          $user = User::create($validated);
        // event(new Registered(($user = User::create($validated)))); only uncomment if i want to send it to the users

           Notification::route('mail', 'jeroldnoynay123@gmail.com')
    ->notify(new AdminEmailVerification($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    


}
