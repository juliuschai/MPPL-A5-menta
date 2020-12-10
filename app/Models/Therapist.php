<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    use HasFactory;

    public function saveDokumenFromRequest($request) {
		$file = $request->file('dokumen');
        $this->dokumen_file = $file->store('dokumen', 'public');
        $this->verified_at = null;
        $this->save();
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
    public function dokumenExists()
    {
        return $this->dokumen_file != null;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
