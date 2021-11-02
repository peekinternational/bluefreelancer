<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    public function deposit()
    {
        $depositHistory = Transaction::where('user_id', auth()->id())->simplePaginate(15);
        return view('transaction.deposit', [
            'depositHistory' => $depositHistory,
        ]);
    }
    public function withdraw()
    {
        $withdrawHistory = Withdraw::where('user_id', auth()->id())->simplePaginate(15);
        return view('transaction.withdraw', [
            'withdrawHistory' => $withdrawHistory,
        ]);
    }
}
