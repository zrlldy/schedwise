<?php

namespace App\Livewire\Auth;

use App\Services\AttemptLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout("components.layouts.auth")]
class Login extends Component
{
    #[Validate("required|string|email")]
    public string $email = "";

    #[Validate("required|string")]
    public string $password = "";

    public bool $remember = false;
    protected int $maxAttempts = 5;
    protected $key;
    protected int $seconds = 10;

    public function login(AttemptLimiter $limiter): void
    {

        $this->validate();
         $limiter->setKey('login'); // Optional, good for separating contexts
         $limiter->setEmail($this->email); //
        $this->key = $limiter->temporalKey(); // for reference, not used directly


         $limiter->checkAttempts($this->maxAttempts, 'auth.throttle', $this->seconds);
        // 1. Check auth
        if (!Auth::attempt(
            ['email' => $this->email, 'password' => $this->password],
            $this->remember
        )) {

            $remaining = $this->maxAttempts - RateLimiter::attempts($this->key);

            throw ValidationException::withMessages([
                'email' => __('auth.failed') . ' ' .
                           __('auth.attempts', ['attempts' => $remaining]),
            ]);


        }
        // 4. Clear lockout and attempts on success
        $limiter->clear();
        Session::regenerate();
        $this->redirectIntended(route('dashboard'), navigate: true);
    }


}
