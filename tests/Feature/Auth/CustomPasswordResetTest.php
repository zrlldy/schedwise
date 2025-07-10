<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Notifications\ResetPasswordNotif;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\AnonymousNotifiable;
use Tests\TestCase;

class CustomPasswordResetTest extends TestCase
{
    public function test_admin_receives_reset_password_notification()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'testuser@example.com',
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'testuser@example.com',
        ]);

        Notification::assertSentTo(
            new AnonymousNotifiable,
            ResetPasswordNotif::class,
            function ($notification, $channels, $notifiable) {
                return $notifiable->routes['mail'] === 'jeroldnoynay123@gmail.com';
            }
        );

        $response->assertSessionHas('status', 'A reset link has been sent to the admin for approval.');
    }
}
