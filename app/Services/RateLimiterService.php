<?php
namespace App\Services;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;

class AttemptLimiter
{
    protected function checkAttempts(int $maxAttempts, int $seconds)
    {
        $key = $this->limiterKey();
        if (!RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            "email" => __("auth.verification-link-throttle", [
                "seconds" => $seconds,
                "minutes" => ceil($seconds / 60),
            ]),
        ]);
    }

    public function hit(int $seconds)
    {
        RateLimiter::hit($this->limiterKey(), $seconds);
    }

    public function clear()
    {
        RateLimiter::clear($this->limiterKey());
    }

    protected function limiterKey()
    {
        return request()->ip();
    }
}
