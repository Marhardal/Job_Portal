<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacancyDeclined extends Notification
{
    use Queueable;

    protected $denied;
    protected $post;

    /**
     * Create a new notification instance.
     */
    public function __construct($denied, $post)
    {
        $this->denied = $denied;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->denied['subject'])
            ->line($this->denied['salutation'])
            ->line($this->denied['body'])
            // ->action('Notification Action', url('/'))
            ->line($this->denied['closing'])
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'title' => 'Vacancy Declined',
            'message' => "Your requisition for the " . $this->post->job->name . " position has been declined!",
        ];
    }
}
