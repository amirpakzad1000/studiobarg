<?php

namespace studiobarg\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use studiobarg\User\Notifications\VerifyMailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
    ];

    protected $hidden = [
        'password',
    ];

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyMailNotification());
    }
}
