<?php

namespace studiobarg\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use studiobarg\User\Mail\VerifyCodeMail;
use studiobarg\User\Services\VerifyCodeService;

class VerifyMailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail(object $notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code);

       return (new VerifyCodeMail($code))
           ->to($notifiable->email);
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
