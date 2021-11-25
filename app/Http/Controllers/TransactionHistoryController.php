<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filter == 'deposit') {
            $transactionHistory = TransactionHistory::where('user_id', auth()->id())->where('type', 1)->simplePaginate(15);
        } elseif ($request->filter == 'withdraw') {
            $transactionHistory = TransactionHistory::where('user_id', auth()->id())->where('type', 2)->simplePaginate(15);
        } elseif ($request->filter == 'milestone') {
            $transactionHistory = TransactionHistory::where('user_id', auth()->id())->where('type', 3)->simplePaginate(15);
        } else {
            $transactionHistory = TransactionHistory::where('user_id', auth()->id())->simplePaginate(15);
        }
        return view('transaction.index', [
            'transactionHistory' => $transactionHistory,
        ]);
    }
}
