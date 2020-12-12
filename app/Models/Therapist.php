<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native roles.
     *
     * @var array
     */
    protected $casts = [
        'opening_hours' => 'datetime',
        'closing_hours' => 'datetime',
        'vacation' => 'boolean',
    ];

    public function saveDocumentFromRequest($request)
    {
        $file = $request->file('document');
        $this->document_file = $file->store('document', 'public');
        $this->verified_at = null;
        $this->save();
    }

    public function saveProfile($request)
    {
        if ($request->email) {$this->email = $request->email;}

        $this->name = $request->name;
        $this->opening_hours = Carbon::parse($request->openingHours);
        $this->closing_hours = Carbon::parse($request->closingHours);
        $this->save();
    }

    public static function getAvailable()
    {
        $timestring = Carbon::now()->format('H:i:s');
        Therapist::where('opening_hours', '>=', $timestring)
            ->where('closing_hours', '<=', $timestring)
            ->where('vacation', false)
            ->get();
    }

    public function isAvailable()
    {
        $now = Carbon::now();

        return $this->vacation == false &&
            $this->opening_hours > $now &&
            $this->closing_hours < $now
            ? true
            : false;
    }

    /**
     * Checks if therapist has verified their documents
     *
     * @return bool returns true if therapist is verified
     */
    public function isVerified()
    {
        return $this->verified_at != null;
    }

    /**
     * Checks if therapist has submited documents
     *
     * @return bool returns true if therapist has submited
     */
    public function documentExists()
    {
        return $this->document_file != null;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
