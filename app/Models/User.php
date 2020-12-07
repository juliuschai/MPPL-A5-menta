<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'phone_num', 'verification_code'];

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
        'verified_at' => 'datetime',
    ];

    public function createVerificationToken()
    {
        $code = mt_rand(100000, 999999);

        $this->fill([
            'verification_code' => $code,
        ])->save();
    }

    /**
     * Verify the current user's phone number
     */
    public function verifyPhone($code)
    {
        if ($code == $this->verification_code) {
            $this->verified_at = now();
            $this->save();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the currently logged in user
     *
     * @return User currently logged in user
     */
    public static function cur()
    {
        return User::findOrFail(Auth::id());
    }

    public function therapist()
    {
        return $this->hasOne('App\Models\Therapist');
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
