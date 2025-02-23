<?php

namespace studiobarg\User\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use studiobarg\RolePermission\Models\Role;
use studiobarg\User\Notifications\ResetPasswordRequestNotification;
use studiobarg\User\Notifications\VerifyMailNotification;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';
    public static $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_BAN
    ];

    public static $defaultUsers = [
        [
            "name" => "John Doe",
            "email" => "admin@admin.com",
            "password" => "demo",
            "role" => Role::ROLE_SUPER_ADMIN
        ]
    ];
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(80)
            ->height(80)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->width(600)
            ->height(600)
            ->sharpen(10)
            ->nonQueued();
    }

}
