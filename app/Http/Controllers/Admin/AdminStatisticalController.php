<?php

namespace App\Http\Controllers\Admin;

use App\HelpersClass\Date;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
// use App\Http\Requests\AdminStatisticalRequest;
// use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStatisticalController extends Controller
{
    public function index(Request $request)
    {
        $transactionStatusDefault = \config('contants.TRANSACTION_GET_STATUS.default');
        $transactionStatusTransported = \config('contants.TRANSACTION_GET_STATUS.transported');
        $transactionStatusSuccess = \config('contants.TRANSACTION_GET_STATUS.success');
        $transactionStatusCancel = \config('contants.TRANSACTION_GET_STATUS.cancel');

        // Tổng đơn hàng
        // $totalTransactions = DB::table('transactions')->select('id')->count();

        // Tổng thành viên
        // $totalUsers = DB::table('users')->select('id')->count();

        // Tổng sản phẩm
        // $totalProducts = DB::table('products')->select('id')->count();

        //danh sach don hang chua xu ly
        // $transactions = Transaction::orderBy('id', 'DESC')->where('tst_status', $transactionStatusDefault)->limit(6)->get();

        //top san pham xem nhieu
        // $topViewProducts = Product::orderByDesc('pro_view')->limit(5)->get();

        //san pham mua nhieu
        // $proPayProducts = Product::orderByDesc('pro_pay')->limit(5)->get();

        //user mua nhieu nhat
        $userTransaction = TransacTion::query()
            ->with('user')
        // ->whereYear('created_at', '2021')
            ->select(DB::raw('sum(tst_total_money) as totalMoney'), 'tst_user_id')
            ->groupBy('tst_user_id')
            ->orderBy('totalMoney', 'DESC')
            ->get();

        $moneyTransaction = Transaction::query();
        // dd(!($request->dateAfter > $request->dateBefore));
        if (!($request->dateBefore && $request->dateAfter)) {
            $message = '';
            if ($request->day) {
                $moneyTransaction->whereDay('created_at', (int) $request->day);
            }
            if ($request->month) {
                $moneyTransaction->whereMonth('created_at', (int) $request->month);
            }
            if ($request->year) {
                if (!($request->day) && !($request->month)) {
                    // ngay va thang k co du lieu. group theo thang trong nam
                    $moneyTransaction = $moneyTransaction
                        ->whereYear('created_at', (int) $request->year)
                        ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('MONTH(created_at) as day'))
                        ->groupBy('day')
                        ->distinct()
                        ->get();
                } else {
                    //nguoc lai ngay thang co du lieu group theo ngay
                    $moneyTransaction = $moneyTransaction
                        ->whereYear('created_at', (int) $request->year)
                        ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
                        ->groupBy('day')
                        ->get();
                }
            } else {
                if ($request->day || $request->month)
                //ngay hoac thang co du lieu va nam k co du lieu nhay vao day query
                {
                    $moneyTransaction = $moneyTransaction
                        ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
                        ->groupBy('day')
                        ->get();
                }

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
        } else {
            if ($request->dateAfter >= $request->dateBefore) {
                $moneyTransaction = $moneyTransaction
                    ->whereBetween(DB::raw('DATE(created_at)'), [$request->dateBefore, $request->dateAfter])
                    ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
                    ->groupBy('day')
                    ->get();
                $totalMoneyTransaction = $moneyTransaction->sum('totalMoney');
                // dd($moneyTransaction);
            } else {
                $request->session()->flash('toastr', [
                    'type' => 'error',
                    'message' => 'chọn ngày sai !',
                ]);

                return redirect()->back();
            }
        }

        //thong ke don hang
        //tiep nhan
        $transactionDefault = Transaction::where('tst_status', (int) $transactionStatusDefault)->select('id')->count();
        //dang van chuyen
        $transactionProcess = Transaction::where('tst_status', (int) $transactionStatusTransported)->select('id')->count();
        // thanh cong
        $transactionSuccess = Transaction::where('tst_status', (int) $transactionStatusSuccess)->select('id')->count();
        // cancel
        $transactionCancel = Transaction::where('tst_status', (int) $transactionStatusCancel)->select('id')->count();
        $statusTransaction = [
            ['Tiếp Nhận', $transactionDefault, false],
            ['Đang Vận Chuyển', $transactionProcess, false],
            ['Bàn Giao', $transactionSuccess, false],
            ['Hủy bỏ', $transactionCancel, false],
        ];

        if ($request->month) {
            // doanh thu moi tiep nhan
            $revenueTransactionMonthDefault = Transaction::where('tst_status', (int) $transactionStatusDefault)
                ->whereMonth('created_at', (int) $request->month)
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            // doanh thu Đang vận chuyển
            $revenueTransactionMonthProcess = Transaction::where('tst_status', (int) $transactionStatusTransported)
                ->whereMonth('created_at', (int) $request->month)
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            //doanh thu theo thang da xu ly
            $revenueTransactionMonthSuccess = Transaction::where('tst_status', (int) $transactionStatusSuccess)
                ->whereMonth('created_at', (int) $request->month)
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            // doanh thu đã hủy bỏ
            $revenueTransactionMonthCancel = Transaction::where('tst_status', (int) $transactionStatusCancel)
                ->whereMonth('created_at', (int) $request->month)
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            $mt = $request->month . ' năm ' . date('Y');
            $month = $request->month;
        } else {
            // doanh thu moi tiep nhan
            $revenueTransactionMonthDefault = Transaction::where('tst_status', (int) $transactionStatusDefault)
                ->whereMonth('created_at', date('m'))
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            // doanh thu Đang vận chuyển
            $revenueTransactionMonthProcess = Transaction::where('tst_status', (int) $transactionStatusTransported)
                ->whereMonth('created_at', date('m'))
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            //doanh thu theo thang da xu ly
            $revenueTransactionMonthSuccess = Transaction::where('tst_status', (int) $transactionStatusSuccess)
                ->whereMonth('created_at', date('m'))
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            // doanh thu đã hủy bỏ
            $revenueTransactionMonthCancel = Transaction::where('tst_status', (int) $transactionStatusCancel)
                ->whereMonth('created_at', date('m'))
                ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) day'))
                ->groupBy('day')
                ->get()->toArray();
            $mt = date('m') . ' năm ' . date('Y');
            $month = date('m');
        }

        $listDay = Date::getListDayInMonth($month);
        $arrRevenueTransactionMonthDefault = [];
        $arrRevenueTransactionMonthProcess = [];
        $arrRevenueTransactionMonthSuccess = [];
        $arrRevenueTransactionMonthCancel = [];

        foreach ($listDay as $day) {
            $total = 0;
            foreach ($revenueTransactionMonthDefault as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthDefault[] = (int) $total;

            $total = 0;
            foreach ($revenueTransactionMonthProcess as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthProcess[] = (int) $total;

            $total = 0;
            foreach ($revenueTransactionMonthSuccess as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthSuccess[] = (int) $total;

            $total = 0;
            foreach ($revenueTransactionMonthCancel as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthCancel[] = (int) $total;
        }
        // dd($arrRevenueTransactionMonthDefault);
        // $moneyTransaction = $moneyTransaction
        // ->whereBetween(DB::raw('DATE(created_at)'), [$request->dateBefore, $request->dateAfter])
        // ->select(DB::raw('sum(tst_total_money) as totalMoney'), DB::raw('DATE(created_at) as day'))
        // ->groupBy('day')
        // ->get();
        // top product t7
        $productsT7 = Order::with('product')->whereMonth('created_at', 7)
            ->select(DB::raw('sum(od_qty) as total, od_product_id'))
            ->groupBy('od_product_id')
            ->orderBy('total', 'DESC')
            ->take(5)
            ->get();

            // dd($products);


        $viewData = [
            // 'totalTransactions' => $totalTransactions,
            // 'totalUsers' => $totalUsers,
            // 'totalProducts' => $totalProducts,
            // 'transactions' => $transactions,
            // 'topViewProducts' => $topViewProducts,
            // 'proPayProducts' => $proPayProducts,
            'userTransaction' => $userTransaction,
            'mt' => $mt,
            'moneyTransaction' => $moneyTransaction,
            'totalMoneyTransaction' => $totalMoneyTransaction,
            'statusTransaction' => json_encode($statusTransaction),
            'listDay' => json_encode($listDay),
            'arrRevenueTransactionMonthDefault' => json_encode($arrRevenueTransactionMonthDefault),
            'arrRevenueTransactionMonthProcess' => json_encode($arrRevenueTransactionMonthProcess),
            'arrRevenueTransactionMonthSuccess' => json_encode($arrRevenueTransactionMonthSuccess),
            'arrRevenueTransactionMonthCancel' => json_encode($arrRevenueTransactionMonthCancel),
            'productsT7' => $productsT7,
        ];
        return view('admin.statistical.index', $viewData);
    }
}
