<?php

namespace App\Services;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;

class AttemptLimiter
{
    protected string $prefix = 'default';
    protected string $email = '';

    public function setKey(string $key): void
    {
        $this->prefix = $key;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function checkAttempts(int $maxAttempts, string $message, int $maxtime): void
    {
        $clonekey = $this->temporalKey();
        $cooldownKey = $this->limiterKey();
        $cooldownCounterKey = "cooldown_count:" . $cooldownKey;

        // 🚫 Check if currently in cooldown
        if (RateLimiter::tooManyAttempts($cooldownKey, 1)) {
            event(new Lockout(request()));
            $seconds = RateLimiter::availableIn($cooldownKey);
            throw ValidationException::withMessages([
                'email' => __($message, ['seconds' => $seconds]),
            ]);
        }

        $attempts = RateLimiter::attempts($clonekey) ?? 0;
        RateLimiter::hit($clonekey);

        if ($attempts +1   >= $maxAttempts) {
            $cooldownCycle = RateLimiter::attempts($cooldownCounterKey);
            $cooldownDuration = min($maxtime * (2 ** $cooldownCycle), 3600);

            RateLimiter::hit($cooldownKey, $cooldownDuration);
            RateLimiter::clear($clonekey);
            RateLimiter::hit($cooldownCounterKey);

            $seconds = RateLimiter::availableIn($cooldownKey);
            throw ValidationException::withMessages([
                'email' => __($message, ['seconds' => $seconds]),
            ]);
        }
    }

    public function clear(): void
    {
        RateLimiter::clear($this->limiterKey());
        RateLimiter::clear($this->temporalKey());
    }

    public function limiterKey(): string
    {
        $ip = request()->ip();
        $email = $this->email ?: 'guest';
       return "{$this->prefix}:{$ip}_and_{$email}";
    }

    public function temporalKey(): string
    {
        return $this->limiterKey() . ':attempts';
    }
}