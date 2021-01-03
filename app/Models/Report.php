<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reported_user_id',
        'reason',
    ];

    public static function createReport($user, $request) {
        return Report::create([
            'user_id' => auth()->id(),
            'reported_user_id' => $user->id,
            'reason' => $request->reason,
        ]);
    }
}
