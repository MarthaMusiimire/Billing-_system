<?php

namespace Modules\Client\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClientEmailVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
      
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = route('client.verify', [
            'id' => $this->client->id,
            'hash' => sha1($this->client->client_email)
        ]);
        return (new MailMessage)
                    ->line('Please click the button below to verify your email address.')
                    ->action('Verify Email', $verificationUrl)
                    ->line('If you did not create an account, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     */
    // public function toArray($notifiable): array
    // {
    //     return [];
    // }
}
