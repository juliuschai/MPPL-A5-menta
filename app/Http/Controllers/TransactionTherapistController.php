<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetFeeRequest;
use App\Models\Therapist;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionTherapistController extends Controller
{
    public function listData()
    {
        $model = Transaction::select([
            'transactions.id',
            'u.name',
            'transactions.start_at',
            'transactions.end_at',
            'transactions.fee',
            'transactions.payment_file_path',
            'transactions.verified_at',
        ])
            ->join('users as u', 'u.id', '=', 'transactions.user_id')
            ->where('transactions.therapist_id', User::cur()->therapist->id)
            ->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function list()
    {
        return view('therapist.transaction.list');
    }

    public function view(Transaction $transaction)
    {
        return view('therapist.transaction.view', compact('transaction'));
    }

    public function save(Transaction $transaction, SetFeeRequest $request)
    {
        if ($transaction->isPaid()) {
            return redirect()
                ->route('therapist.transaction.list')
                ->withErrors(['Transaksi telah dibayar!']);
        }

        $transaction->setFee($request->harga);

        return redirect()
            ->route('therapist.transaction.list')
            ->with(['message' => 'Perubahan berhasil!']);
    }
}
