<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\HelpersClass\Date;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $transactionStatusDefault = \config('contants.TRANSACTION_GET_STATUS.default');
        $transactionStatusTransported = \config('contants.TRANSACTION_GET_STATUS.transported');
        $transactionStatusSuccess = \config('contants.TRANSACTION_GET_STATUS.success');
        $transactionStatusCancel = \config('contants.TRANSACTION_GET_STATUS.cancel');

        // Tổng đơn hàng
        $totalTransactions  = DB::table('transactions')->select('id')->count();

        // Tổng thành viên
        $totalUsers         = DB::table('users')->select('id')->count();

        // Tổng sản phẩm
        $totalProducts      = DB::table('products')->select('id')->count();

        //danh sach don hang chua xu ly
        $transactions       = Transaction::orderBy('id', 'DESC')->where('tst_status', $transactionStatusDefault)->limit(6)->get();

        //top san pham xem nhieu
        $topViewProducts    = Product::orderByDesc('pro_view')->limit(5)->get();

        //san pham mua nhieu
        $proPayProducts    = Product::orderByDesc('pro_pay')->limit(5)->get();

        $moneyTransaction = Transaction::query();

        $message = '';
        if ($request->day) {
            $moneyTransaction->whereDay('created_at', (int)$request->day);
        }
        if ($request->month) {
            $moneyTransaction->whereMonth('created_at', (int)$request->month);
        }
        if ($request->year) {
            if (!($request->day) && !($request->month)) {
                // ngay va thang k co du lieu. group theo thang trong nam
                $moneyTransaction = $moneyTransaction
                    ->whereYear('created_at', (int)$request->year)
                    ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('MONTH(created_at) as day'))
                    ->groupBy('day')
                    ->distinct()
                    ->get();
            } else {
                //nguoc lai ngay thang co du lieu group theo ngay
                $moneyTransaction = $moneyTransaction
                    ->whereYear('created_at', (int)$request->year)
                    ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
                    ->groupBy('day')
                    ->get();
            }
        } else {
            if ($request->day || $request->month)
                //ngay hoac thang co du lieu va nam k co du lieu nhay vao day query
                $moneyTransaction = $moneyTransaction
                    ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
                    ->groupBy('day')
                    ->get();
        }
        if (!($request->day) && !($request->month) && !($request->year)) {
            // $moneyTransaction->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
            $moneyTransaction = $moneyTransaction
                ->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
                ->groupBy('day')
                ->get();
        }




        // $moneyTransaction = $moneyTransaction
        //     ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
        //     ->groupBy('day')
        //     ->get();
        $totalMoneyTransaction = $moneyTransaction->sum('totalMoney');

        
        

        $viewData = [
            'totalTransactions' => $totalTransactions,
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'transactions' => $transactions,
            'topViewProducts' => $topViewProducts,
            'proPayProducts' => $proPayProducts,
            'moneyTransaction' => $moneyTransaction,
            'totalMoneyTransaction' => $totalMoneyTransaction,
            
        ];
        return view('admin.index', $viewData);
    }

    public function readNotify(Request $request, $id)
    {
        if ($request->ajax()) {
            $notify = DB::table('notifications')->where('id', $id)->update(['read_at' => Carbon::now()]);
            return true;
        }
    }

    // public function readNotifyAll(Request $request)
    // {
    //     if($request->ajax()) {
    //         $notifies = DB::table('notifications')->where('read_at', NULL)->update(array('read_at' => Carbon::now()));
    //         // return response([
    //         //     'notifies' => $notifies
    //         // ]);
    //         // foreach($notifies as $notify) {
    //         //     $notify->update(['read_at' => Carbon::now()]);
    //         // }
    //         return true;
    //     }
    // }
}
