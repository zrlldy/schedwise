<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Notification;
use App\Mail\AdminResetPasswordLink;
use App\Models\User;
use App\Notifications\ResetPasswordNotif;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class ForgotPassword extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the admin for the provided user email.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'We can\'t find a user with that email address.');
            return;
        }

        // Generate reset token for the user
        $token = Password::createToken($user);

        // Send email to the admin instead of the user
  

    Notification::route('mail', 'jeroldnoynay123@gmail.com')
    ->notify(new ResetPasswordNotif($user, $token));

    

        session()->flash('status', __('A reset link has been sent to the admin for approval.'));
    }
}