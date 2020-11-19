<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native roles.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the currently logged in user
     *
     * @return User currently logged in user
     */
    public static function cur()
    {
        return User::findOrFail(Auth::id());
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isTherapist()
    {
        return $this->role == 'therapist';
    }

    public function isPatient()
    {
        return $this->role == 'patient';
    }
}
