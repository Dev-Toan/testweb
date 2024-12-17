<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $email_user = Auth::user()->email;
        $transaction_total = Transaction::where('tst_email', $email_user)->count();
        $transaction_transported = Transaction::where('tst_status', config('contants.TRANSACTION_GET_STATUS.transported'))
            ->where('tst_email', $email_user)->count();
        $transaction_default = Transaction::where('tst_status', config('contants.TRANSACTION_GET_STATUS.default'))
            ->where('tst_email', $email_user)->count();
        $transaction_success = Transaction::where('tst_status', config('contants.TRANSACTION_GET_STATUS.success'))
            ->where('tst_email', $email_user)->count();
        $transaction_cancel = Transaction::where('tst_status', config('contants.TRANSACTION_GET_STATUS.cancel'))
            ->where('tst_email', $email_user)->count();
        $viewData = [
            'transaction_total' => $transaction_total,
            'transaction_transported' => $transaction_transported,
            'transaction_success' => $transaction_success,
            'transaction_cancel' => $transaction_cancel,
            'transaction_default' => $transaction_default,
        ];

        return view('frontend.user.dashboard', $viewData);
    }
}
