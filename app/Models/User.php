<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use PhpJunior\LaravelVideoChat\Models\Message\Message;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_num',
        'verification_code',
    ];

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

    public function saveProfilePic($request)
    {
        $file = $request->file('profilePic');
        $this->profile_pic_file = $file->store('profilePicture', 'public');
        $this->save();
    }

    public function saveProfile($request)
    {
        if ($request->email) {
            $this->email = $request->email;
        }

        $this->name = $request->name;
        $this->save();
    }

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

    public function block()
    {
        $this->blocked_at = now();
        $this->save();
    }

    public function unblock()
    {
        $this->blocked_at = null;
        $this->save();
    }

    public function isBlocked() {
        return $this->blocked_at != null;
    }

    public function hasUnreadChat()
    {
        $lastMessage = Message::latest('messages.created_at')
            ->join('conversations as c', 'c.id', '=', 'messages.conversation_id')
            ->where('c.first_user_id', auth()->id())
            ->orWhere('c.second_user_id', auth()->id())
            ->first('messages.created_at');

        if (!$lastMessage) {
            return false;
        }

        $lastTimeStr = Cookie::get('lastChatTime') ?? '1970-01-01 00:00:00';
        $lastTime = Carbon::parse($lastTimeStr);

        // if last message is newer than user's last vist to chat.list
        $result = $lastMessage->created_at->gt($lastTime);

        return $result;
    }

    public function isInDebt()
    {
        return Transaction::where('user_id', auth()->id())
                ->whereNull('payment_file_path')
                ->exists();
    }

    /**
     * Checks if user has verified their phone
     *
     * @return bool returns true if user is verified
     */
    public function isVerified()
    {
        return $this->verified_at != null;
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
