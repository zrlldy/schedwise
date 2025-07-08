<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\URL;
class AdminEmailVerification extends Notification
{
    use Queueable;
    public $user;
    
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
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
      $user = $this->user;
    $signedUrl = URL::temporarySignedRoute(
        'admin.verify',
        now()->addMinutes(60), // expires in 60 minutes
        ['user' => $user->id]
    );

    return (new MailMessage)
        ->subject('New Account Needs Verification')
        ->greeting('Hello, Admin')
        ->line("A new user has registered:")
        ->line("Name: {$this->user->name}")
        ->line('Click this Button below to verify the user')
       ->action('Verify User', $signedUrl)
       
        ->salutation(new HtmlString("Thanks, <br>". config('app.name')));
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
