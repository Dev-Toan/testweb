<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::query();
        if ($id = $request->id) {
            $transactions->where('id', $id);
        }
        if ($email = $request->email) {
            $transactions->where('tst_email', 'like', '%' . $email . '%');
        }
        if ($type = $request->type) {
            if ($type == 1) {
                $transactions->where('tst_user_id', '<>', 0);
            }
            if ($type == 2) {
                $transactions->where('tst_user_id', 0);
            }
        }
        if ($status = $request->status) {
            $transactions->where('tst_status', $status);
        }
        $transactions = $transactions->orderByDesc('id')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
        $viewData = [
            'transactions'  =>  $transactions,
            'query'         =>  $request->query()
        ];
        return view('admin.transaction.index', $viewData);
    }

    public function getTransactionDetail(Request $request, $id)
    {
        $transaction = Transaction::query()->findOrFail($id);
        $order = Order::with('product:id,pro_name,pro_slug,pro_avatar')
            ->where('od_transaction_id', $id)
            ->get();
        return view('admin.transaction.view', compact('transaction', 'order'));
    }

    public function getAction($action, $id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            if($transaction->tst_status != -1) {
                switch ($action) {
                    case 'process':
                        $transaction->tst_status = 2;
                        break;
                    case 'success':
                        $transaction->tst_status = 3;
                        break;
                    case 'cancel':
                        $transaction->tst_status = -1;
                        DB::beginTransaction();
                        try {
                            $orders = Order::where('od_transaction_id', $id)->get();
                            foreach ($orders as $order) {
                                Product::where('id',$order->od_product_id)->decrement('pro_pay', $order->od_qty);
                                // Product::where('id',$order->od_product_id)->decrement('pro_number', $order->od_qty);
                            }
                        } catch (\Exception $e) {
                            DB::rollBack();
                            return redirect()->back();
                        }
                        DB::commit();
                        break;
                }
                $transaction->save();
            }
        }
        return redirect()->back();
    }

    public function order_detail_delete(Request $request, $id)
    {
        $order = Order::findOrfail($id);
        if ($order) {
            // if($order->od_sale){
            //     $money=$order->od_qty * ((100-$order->od_sale)/100) * $order->od_price;
            // }else{
            // }
            $money = $order->od_qty *  $order->od_price;

            DB::table('transactions')
                ->where('id', $order->od_transaction_id)
                ->decrement('tst_total_money', $money);
            DB::table('products')
                ->where('id', $order->od_product_id)
                ->decrement('pro_pay', $order->od_qty);
            $order->delete();
        }
        return redirect()->back();
    }

    public function delete($id)
    {
        $transaction = Transaction::findOrfail($id);
        // $order=Order::query()->where('od_transaction_id',$id)->get();
        if ($transaction) {
            // if($order){
            //     foreach($order as $item){
            //         DB::table('products')
            //         ->where('id',$item->od_product_id)
            //         ->decrement('pro_pay',$item->od_qty);
            //     }
            // }
            $transaction->delete();
            DB::table('orders')->where('od_transaction_id', $id)->delete();
        }
        return redirect()->back();
    }


    // if($transaction->tst_status != -1) {
    //     switch ($action) {
    //         case 'process':
    //             $transaction->tst_status = 2;
    //             break;
    //         case 'success':
    //             $transaction->tst_status = 3;
    //             break;
    //         case 'cancel':
    //             $transaction->tst_status = -1;
    //             DB::beginTransaction();
    //             try {
    //                 $orders = Order::where('od_transaction_id', $id)->get();
    //                 foreach ($orders as $order) {
    //                     Product::where('id',$order->od_product_id)->decrement('pro_pay', $order->od_qty);
    //                     // Product::where('id',$order->od_product_id)->decrement('pro_number', $order->od_qty);
    //                 }
    //             } catch (\Exception $e) {
    //                 DB::rollBack();
    //                 return redirect()->back();
    //             }
    //             DB::commit();
    //             break;
    //     }
    //     $transaction->save();
    // }
}
