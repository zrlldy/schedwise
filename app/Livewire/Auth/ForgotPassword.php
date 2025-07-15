<?php

namespace App\Livewire\Auth;
use App\Services\AttemptLimiter;
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
    protected $key;
    protected int $maxAttempts = 2;
    protected int $seconds = 20;
   
public function sendPasswordResetLink(AttemptLimiter $limiter): void
{
    $this->validate([
        "email" => ["required", "string", "email"],
    ]);

    // Set limiter key based on email + IP for uniqueness
    $limiter->temporalKey('forgot-password:' . request()->ip() . '|' . $this->email);
    $this->key = $limiter->temporalKey();

    // Check if user exists first
    $user = User::where("email", $this->email)->first();

    if (!$user) {
        // Still allow limiter to count it
       
        $limiter->checkAttempts($this->maxAttempts, 'auth.throttle', $this->seconds);
        $this->addError(
            "email",
            'We can\'t find a user with that email address.'
        );
        return;
    }

    // At this point, user exists → Check limiter
    $limiter->checkAttempts($this->maxAttempts, 'auth.throttle', $this->seconds);

    // Send token
    $token = Password::createToken($user);
    Notification::route("mail", "jeroldnoynay123@gmail.com")->notify(
        new ResetPasswordNotif($user, $token)
    );

    session()->flash(
        "status",
        __("A reset link has been sent to the admin for approval.")
    );

    // ✅ Clear only on success
  
}
}
