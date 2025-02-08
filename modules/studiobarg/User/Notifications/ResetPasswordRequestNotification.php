<?php

namespace studiobarg\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use studiobarg\User\Mail\ResetPasswordRequestMail;
use studiobarg\User\Services\VerifyCodeService;

class ResetPasswordRequestNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code,120);

       return (new ResetPasswordRequestMail($code))
           ->to($notifiable->email);
    }


    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
