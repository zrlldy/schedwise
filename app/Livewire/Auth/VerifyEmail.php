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
    protected $message = "auth.throttle";
    protected int $seconds = 60;

    /**
     * Send an email verification notification to the user.
     */

        public function mount()
        {

                if(Auth::user()->hasVerifiedEmail()){
                    return redirect('/dashboard');
                }
        }

    public function sendVerification(AttemptLimiter $limiter): void
    {
        $email = Auth::user()->email;
        // $this->mailSendLimiter();
           $limiter->setEmail($email);
           $limiter->setKey('VerifyEmail');
          $key = $limiter->temporalKey();
            $limiter->checkAttempts($this->max, $this->message, $this->seconds);
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(
                default: route("dashboard", absolute: false),
                navigate: true
            );
            return;
            
        }


        Notification::route("mail", "jeroldnoynay123@gmail.com")->notify(
            new AdminEmailVerification(Auth::user())
        );

        Session::flash("status", "verification-link-sent");

    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect("/", navigate: true);
    }
}
