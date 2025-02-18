<?php

namespace studiobarg\User\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use studiobarg\User\Notifications\ResetPasswordRequestNotification;
use studiobarg\User\Notifications\VerifyMailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
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
    public function sendResetPasswordRequestNotification(): void
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

}
