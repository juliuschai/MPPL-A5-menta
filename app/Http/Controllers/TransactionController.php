<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndCallRequest;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function listDataForAdmin()
    {
        $model = (new Transaction())->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function listForAdmin() {
        return view('admin.transaction.list');
    }

    public function listDataForTherapist()
    {
        $model = Transaction::where('therapist_id', User::cur()->therapist->id)
                ->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function listForTherapist() {
        return view('therapist.transaction.list');
    }

    public function listDataForPatient()
    {
        $model = Transaction::where('user_id', auth()->id())
                ->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function listForPatient() {
        return view('transaction.list');
    }

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

        return redirect()->route('therapist.call.end', ['transaction' => $transaction]);
    }

    public function viewEndCall(Transaction $transaction)
    {
        return view('therapist.transaction.end')->with(compact('transaction'));
    }

    public function saveEndCall(EndCallRequest $request)
    {
        return redirect()->route('therapist.transaction.list');
    }
}
