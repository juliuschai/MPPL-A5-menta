<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'therapist_id'];

    public function uploadPaymentFile($request)
    {
        $file = $request->file('document');
        $this->payment_file_path = $file->store('payment', 'public');
        $this->save();
    }

    public function denyPayment()
    {
        FileHelper::deleteDocumentOrFail($this->payment_file_path);
        $this->payment_file_path = null;
        $this->save();
    }

    public function acceptPayment()
    {
        $time = Carbon::now()->addHours(7); // shift to gmt+7
        $this->verified_at = $time;
        $this->save();
    }

    /**
     * Accessor for custom attribute total (amount paid by user)
     */
    public function getTotalAttribute()
    {
        return $this->fee * 1.1;
    }

    /**
     * Start new meeting
     */
    public static function new($id1, $id2)
    {
        $user1 = User::find($id1);
        $user2 = User::find($id2);
        if (!$user1) {
            Log::error("User with id {$id1} doesn't exist");
            return;
        } elseif (!$user2) {
            Log::error("User with id {$id2} doesn't exist");
            return;
        }
        $therapist = Transaction::getTherapist($user1, $user2);
        $patient = Transaction::getPatient($user1, $user2);
        if (!$patient) {
            Log::error("Patient doesn't exist between id {$id1} and {$id2}");
            return;
        } elseif (!$therapist) {
            Log::error("Patient doesn't exist between id {$id1} and {$id2}");
            return;
        }

        $transaction = Transaction::create([
            'user_id' => $patient->id,
            'therapist_id' => $therapist->id,
        ]);
        return $transaction->id;
    }

    /**
     * finish current meeting
     */
    public function finish($time)
    {
        $this->end_at = $time;
        $this->save();
    }

    /**
     * Set fee for the meeting
     */
    public function setFee($fee)
    {
        if ($this->fee == 0) {
            $this->setFree();
        } else {
            $this->fee = $fee;
        }
        $this->save();
    }

    /**
     * Set the current meeting as a free meeting
     */
    public function setFree()
    {
        $this->payment_file_path = 'free';
        $time = Carbon::now()->addHours(7); // shift to gmt+7
        $this->verified_at = $time;
        return;
    }

    /**
     * returns wether or not admin has verfiied the transaction
     */
    public function isVerified()
    {
        return $this->verified_at != null;
    }

    /**
     * Returns wether or not user has uploaded proof of transfer
     */
    public function isPaid()
    {
        return $this->payment_file_path != null;
    }

    /**
     * Returns wether or not meeting is free (Rp0)
     */
    public function isFree()
    {
        return $this->payment_file_path == 'free';
    }

    /**
     * Given two user Ids, one of patient and one of therapist
     * returns the patient
     */
    private static function getPatient($user1, $user2)
    {
        if ($user1->isPatient()) {
            return $user1;
        } elseif ($user2->isPatient()) {
            return $user2;
        } else {
            Log::error(
                "None of the users ({$user1->id}, {$user2->id}), are patients"
            );
        }
    }

    /**
     * Given two user Ids, one of patient and one of therapist
     * returns the therapist
     */
    private static function getTherapist($user1, $user2)
    {
        if ($user1->isTherapist()) {
            return $user1->therapist;
        } elseif ($user2->isTherapist()) {
            return $user2->therapist;
        } else {
            Log::error(
                "None of the users ({$user1->id}, {$user2->id}), are therapists"
            );
        }
    }
}
