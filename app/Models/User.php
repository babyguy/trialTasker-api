<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Caso;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,MustVerifyEmailTrait;

    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'address',
        'email',
        'password',
        'confirmed',
        'confirmation_code',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cases()
    {
        return $this->hasMany(Caso::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}