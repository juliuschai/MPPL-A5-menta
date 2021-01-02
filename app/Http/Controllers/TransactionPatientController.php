<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPaymentRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionPatientController extends Controller
{
    public function listData()
    {
        $model = Transaction::select([
            'transactions.id',
            't.name',
            'transactions.start_at',
            'transactions.end_at',
            DB::raw('(transactions.fee * 1.1) as fee'),
            'transactions.payment_file_path',
            'transactions.verified_at',
        ])
            ->join('therapists as temp', 'temp.id', '=', 'transactions.therapist_id')
            ->join('users as t', 't.id', '=', 'temp.user_id')
            ->where('transactions.user_id', auth()->id())
            ->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function list()
    {
        return view('transaction.list');
    }

    public function view(Transaction $transaction)
    {
        return view('transaction.view', compact('transaction'));
    }

    public function save(
        Transaction $transaction,
        UploadPaymentRequest $request
    ) {
        if ($transaction->isVerified()) {
            return redirect()
                ->route('transaction.list')
                ->withErrors(['Transaksi telah diverifikasi!']);
        }

        $transaction->uploadPaymentFile($request);

        return redirect()
            ->route('transaction.list')
            ->with(['message' => 'Upload berhasil!']);
    }
}
