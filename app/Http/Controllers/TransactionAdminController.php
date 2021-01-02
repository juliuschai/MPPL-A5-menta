<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransactionAdminController extends Controller
{
    public function listData()
    {
        $model = Transaction::select([
            'transactions.id',
            'u.name as pasienName',
            't.name as therapistName',
            'transactions.start_at',
            'transactions.end_at',
            DB::raw('(transactions.fee * 1.1) as fee'),
            'transactions.payment_file_path',
            'transactions.verified_at',
        ])
            ->join('users as u', 'u.id', '=', 'transactions.user_id')
            ->join(
                'therapists as temp',
                'temp.id',
                '=',
                'transactions.therapist_id'
            )
            ->join('users as t', 't.id', '=', 'temp.user_id')
            ->newQuery();

        return DataTables::eloquent($model)->toJson();
    }

    public function list()
    {
        return view('admin.transaction.list');
    }

    public function view(Transaction $transaction)
    {
        return view('admin.transaction.view', compact('transaction'));
    }

    public function accept(Transaction $transaction)
    {
        $transaction->acceptPayment();

        return redirect()
            ->route('admin.transaction.list')
            ->with('message', 'payment denied');
    }

    public function deny(Transaction $transaction)
    {
        $transaction->denyPayment();

        return redirect()
            ->route('admin.transaction.list')
            ->with('message', 'payment denied');
    }
}
