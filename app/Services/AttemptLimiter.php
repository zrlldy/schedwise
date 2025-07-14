<?php
namespace App\Services;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;

class AttemptLimiter
{
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
             if ($attempts + 1 >= $maxAttempts) {

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
        return request()->ip(); // or use email|ip if needed
    }

    public function temporalKey(): string
    {
        return $this->limiterKey() . ':attempts';
    }
}
