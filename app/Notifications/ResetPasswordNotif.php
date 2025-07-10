<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotif extends Notification
{
    use Queueable;

    public $user;
    public $token;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $usermail,string $token)
    {
            $this->user = $usermail;
            $this->token = $token;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
   public function toMail(object $notifiable): MailMessage
{
    // Only pass the email to urlencode, not the whole user object
    $url = url("/reset-password/{$this->token}?email=" . urlencode($this->user->email));

    return (new MailMessage)
        ->subject("Reset Link for {$this->user->email}")
        ->line("A password reset was requested for: {$this->user->name}")
        ->line("Email of the user: {$this->user->email}")
        ->action('Reset Password', url: $url)
        ->line('You are receiving this because you are an admin.');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
