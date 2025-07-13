<?php

namespace App\Livewire\Auth;

use App\Livewire\Actions\Logout;
use App\Notifications\AdminEmailVerification;
use App\Services\AttemptLimiter;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

#[Layout("components.layouts.auth")]
class VerifyEmail extends Component
{
    protected $max = 3;
    protected $message = "auth.verification-link-throttle";
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(AttemptLimiter $limiter): void
    {
        // $this->mailSendLimiter();

        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(
                default: route("dashboard", absolute: false),
                navigate: true
            );
            return;
        }

        $limiter->checkAttempts($this->max, 60, $this->message);
        Notification::route("mail", "jeroldnoynay123@gmail.com")->notify(
            new AdminEmailVerification(Auth::user())
        );

        Session::flash("status", "verification-link-sent");
    }

    // protected function mailSendLimiter()
    // {
    //     if (!RateLimiter::tooManyAttempts($this->limiterKey(), $this->max)) {
    //         return;
    //     }

    //     event(new Lockout(request()));
    //     $seconds = RateLimiter::availableIn($this->limiterKey());
    //     throw ValidationException::withMessages([
    //         "email" => __("auth.verification-link-throttle", [
    //             "seconds" => $seconds,
    //             "minutes" => ceil($seconds / 60),
    //         ]),
    //     ]);
    // }

    // protected function limiterKey()
    // {
    //     return request()->ip();
    // }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect("/", navigate: true);
    }
}
