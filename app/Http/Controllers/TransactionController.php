<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetFeeRequest;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function answerCall(Request $request)
    {
        $id = Transaction::new($request->from, $request->to);
        return response()->json([
            'id' => $id,
        ]);
    }

    public function finishCall(Transaction $transaction, Request $request)
    {
        $transaction->finish(Carbon::parse(substr($request->userTime, 0, 24)));

        return redirect()->route('therapist.call.end', [
            'transaction' => $transaction,
        ]);
    }

    public function viewEndCall(Transaction $transaction)
    {
        return view('therapist.transaction.end')->with(compact('transaction'));
    }

    public function saveEndCall(
        Transaction $transaction,
        SetFeeRequest $request
    ) {
        $transaction->setFee($request->harga);

        return redirect()->route('therapist.transaction.list');
    }
}
