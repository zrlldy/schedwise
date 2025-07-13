<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Notification;
use App\Mail\AdminResetPasswordLink;
use App\Models\User;
use App\Notifications\ResetPasswordNotif;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

#[Layout("components.layouts.auth")]
class ForgotPassword extends Component
{
    public string $email = "";

    /**
     * Send a password reset link to the admin for the provided user email.
     */

    // gonna something here later
    public int $remaining = 0;

    public function mount(AttemptLimiter $limiter)
    {
        $this->remaining = $limiter->remainingAttempts($this->max);
    }
    public function sendPasswordResetLink(): void
    {
        $this->isNotLimitPasswordResestLink();
        $this->validate([
            "email" => ["required", "string", "email"],
        ]);

        $user = User::where("email", $this->email)->first();

        if (!$user) {
            $this->addError(
                "email",
                'We can\'t find a user with that email address.'
            );
            return;
        }

        // Generate reset token for the user
        $token = Password::createToken($user);

        // Send email to the admin instead of the user
        Notification::route("mail", "jeroldnoynay123@gmail.com")->notify(
            new ResetPasswordNotif($user, $token)
        );

        RateLimiter::hit($this->keyLimiter(), 60);

        session()->flash(
            "status",
            __("A reset link has been sent to the admin for approval.")
        );
    }

    protected function isNotLimitPasswordResestLink()
    {
        if (!RateLimiter::tooManyAttempts($this->keyLimiter(), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->keyLimiter());
        throw ValidationException::withMessages([
            "email" => __("auth.verification-link-throttle", [
                "seconds" => $seconds,
                "minutes" => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function keyLimiter()
    {
        return request()->ip();
    }
}
