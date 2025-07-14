<?php
namespace App\Services;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;

class AttemptLimiter
{
    public function checkAttempts(int $maxAttempts, $message,)
    {
        $key = $this->limiterKey();
        if (!RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            "email" => __($message, [
                "seconds" => $seconds,
            ]),
        ]);

        // $this->message($key, $message, $seconds);

        $attemptKey = $key . ":attempts";
        $attempts = RateLimiter::attempts($attemptKey);
        RateLimiter::hit($attemptKey, $seconds);
        if($attempts+1 >= $maxAttempts) {
            RateLimiter::hit($key, $seconds);
            RateLimiter::clear($attemptKey);

        }

    }
    public function clear(){
        RateLimiter::clear($this->limiterKey());
        RateLimiter::clear($this->limiterKey() . ":attempts"); 
    }

    
    public function limiterKey()
    {
        return request()->ip();
    }
}
