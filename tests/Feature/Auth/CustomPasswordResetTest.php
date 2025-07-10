<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Notifications\ResetPasswordNotif;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class CustomPasswordResetTest extends TestCase
{
    use RefreshDatabase;

   public function test_admin_receives_reset_password_notification()
{
    Notification::fake();

    $user = User::factory()->create([
        'email' => 'testuser@example.com',
    ]);

    Livewire::test(\App\Livewire\Auth\ForgotPassword::class)
        ->set('email', $user->email)
        ->call('sendPasswordResetLink')
        ->assertSee('A reset link has been sent to the admin for approval.');

    Notification::assertSentOnDemand(
        \App\Notifications\ResetPasswordNotif::class,
        fn ($notification, $channels, $notifiable) =>
            $notifiable->routeNotificationFor('mail') === 'jeroldnoynay123@gmail.com'
    );
}
}