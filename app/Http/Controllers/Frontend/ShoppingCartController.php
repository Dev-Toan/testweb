<?php

namespace App\Http\Controllers\Frontend;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\TransactionSuccess;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $shopping = \Cart::content();
        $viewData = [
            'shopping' => $shopping,
            'title_page' => 'Danh Sách Giỏ Hàng',
        ];
        return view('frontend.pages.shopping.index', $viewData);
    }

    //them gio hang
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if ($request->ajax()) {
            if (!$product) {
                return redirect()->to('/');
            }
            $rowID = \Cart::content()->search(function ($cartItem, $rowId) use ($product) {
                return $cartItem->id === $product->id;
            });
            if ($rowID) {
                $item = \Cart::get($rowID);
                if (($product->pro_number - ($product->pro_pay + (int) $item->qty)) <= 0) {
                    return response([
                        'code' => 400,
                        'messages' => 'Số lượng sản phẩm không đủ',
                        'total_qty' => \Cart::count(),
                    ]);
                }

            }
            if (($product->pro_number - $product->pro_pay) <= 0) {
                return response([
                    'code' => 400,
                    'messages' => 'Sản Phẩm đã hết hàng vui lòng chọn sản phẩm khác',
                    'total_qty' => \Cart::count(),
                ]);
            }
            \Cart::add([
                'id' => $product->id,
                'name' => $product->pro_name,
                'qty' => 1,
                'price' => number_price($product->pro_price, $product->pro_sale),
                'weight' => 1,
                'options' => [
                    'sale' => $product->pro_sale,
                    'price_old' => $product->pro_price,
                    'image' => $product->pro_avatar,
                ],
            ]);
            return response([
                'code' => 200,
                'messages' => 'Bạn Đã Thêm Thành Công !',
                'total_qty' => \Cart::count(),
            ]);
        }

        $product = Product::find($id);
        //1. kiem tra ton tai san pham
        if (!$product) {
            return redirect()->to('/');
        }
        if (isset($request->quantity)) {
            $sl = $request->quantity;
        } else {
            $sl = 1;
        }

        //2. kiem tra so luong san pham
        if (($product->pro_number - $product->pro_pay) < $sl) {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Số lượng sản phẩm không đủ !',
            ]);
            return redirect()->back();
        }

        //3. them san pham vao gio hang
        \Cart::add([
            'id' => $product->id,
            'name' => $product->pro_name,
            'qty' => $sl,
            'price' => number_price($product->pro_price, $product->pro_sale),
            'weight' => 1,
            'options' => [
                'sale' => $product->pro_sale,
                'price_old' => $product->pro_price,
                'image' => $product->pro_avatar,
            ],
        ]);
        \Session::flash('toastr', [
            'type' => 'success',
            'message' => 'Đã Thêm Mới 1 SP vào giỏ hàng !',
        ]);
        return redirect()->back();
    }

    public function delete(Request $request, $rowId)
    {
        \Cart::remove($rowId);
        if ($request->ajax()) {
            return response([
                'data' => 'Bạn Xóa 1 sản phẩm thành công nhen !',
                'total' => \Cart::subtotal(0),
                'total_qty' => \Cart::count(),
            ]);
        }
        \Session::flash('toastr', [
            'type' => 'error',
            'message' => 'Bạn Đã Xóa 1 SP Trong Giỏ Hàng !',
            'total' => \Cart::subtotal(0),
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $qty = $request->number ?? 1;
            $productID = $request->productID;
            $product = Product::find($productID);

            if (!$product) {
                return response(['data' => 'không tòn tại sp cần update !']);
            }
            if (($product->pro_number - $product->pro_pay) < $qty) {
                \Cart::update($id, 1);
                return response(
                    [
                        'data' => 'Số lượng không có đủ nhá !',
                        'error' => true,
                        'total' => \Cart::subtotal(0),
                        'total_qty' => \Cart::count(),
                        'totalitem' => number_format(number_price($product->pro_price, $product->pro_sale) * 1, 0, ',', '.'),
                    ]
                );
            }
            \Cart::update($id, $qty);
            return response(
                [
                    'data' => 'Thành công nhen !',
                    'total' => \Cart::subtotal(0),
                    'total_qty' => \Cart::count(),
                    'totalitem' => number_format(number_price($product->pro_price, $product->pro_sale) * $qty, 0, ',', '.'),
                ]
            );
        }
    }

    public function postPay(Request $request)
    {
        if ($request->pay == 1) {
            if (\Cart::count() <= 0) {
                $request->session()->flash('toastr', [
                    'type' => 'warning',
                    'message' => 'Không có sản phẩm nào để thanh toán !',
                ]);
                return redirect('/');
            }
            DB::beginTransaction();
            $data = $request->except('_token');
            if (isset(Auth::user()->id)) {
                $data['tst_user_id'] = Auth::user()->id;

                $email = Auth::user()->email;
                $name = Auth::user()->name;
                $phone = Auth::user()->phone;
                $address = Auth::user()->address;

                $data['tst_total_money'] = str_replace(',', '', \Cart::subtotal(0));
                $data['tst_name'] = $name;
                $data['tst_email'] = $email;
                $data['tst_phone'] = $phone;
                $data['tst_address'] = $address;
            } else {
                $email = $request->tst_email;
                $name = $request->tst_name;
                $phone = $request->tst_phone;
                $address = $request->tst_address;
                $data['tst_total_money'] = str_replace(',', '', \Cart::subtotal(0));
            }

            $dataInsert['tst_user_id'] = Auth::user()->id;
            $dataInsert['tst_total_money'] = str_replace(',', '', \Cart::subtotal(0));
            $dataInsert['tst_name'] = $request->tst_name;
            $dataInsert['tst_email'] = $request->tst_email;
            $dataInsert['tst_phone'] = $request->tst_phone;
            $dataInsert['tst_address'] = $request->tst_address;
            $dataInsert['tst_note'] = $request->tst_note;

            try {
                $transaction = Transaction::query()->create($dataInsert);
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('get.home');
            }
            if ($transaction) {
                $shopping = \Cart::content();

                foreach ($shopping as $key => $item) {
                    try {
                        // luu chitietdonhang
                        Order::create([
                            'od_transaction_id' => $transaction->id,
                            'od_product_id' => $item->id,
                            'od_sale' => $item->options->sale,
                            'od_qty' => $item->qty,
                            'od_price' => $item->price,
                        ]);
                        //pro_pay luot mua
                        DB::table('products')->where('id', $item->id)->increment('pro_pay', $item->qty);
                        // DB::table('products')->where('id',$item->id)->decrement('pro_number',$item->qty);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return redirect()->route('get.home');
                    }
                }
                Mail::to($email)->send(new TransactionSuccess($shopping, $name));
            }
            DB::commit();
            $dataMessage = [
                'name' => $name,
                'message' => 'Vừa mua sản phẩm.',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ];
            event(new NotificationEvent($dataMessage));
            $tt = 'Thanh toán khi giao hàng (COD)';
            return redirect()->route('get.success.list')->with(['success' => 'ok', 'email' => $email, 'address' => $address, 'name' => $name, 'phone' => $phone, 'tt' => $tt]);
        } else {
            if (\Cart::count() <= 0) {
                $request->session()->flash('toastr', [
                    'type' => 'warning',
                    'message' => 'Không có sản phẩm nào để thanh toán !',
                ]);
                return redirect('/');
            }
            $tst_total_money = str_replace(',', '', \Cart::subtotal(0));
            $data = $request->except('_token', 'pay');
            $data['tst_user_id'] = Auth::user()->id;
            $data['tst_total_money'] = str_replace(',', '', \Cart::subtotal(0));
            $data['tst_type'] = 2;
            session(['data_customer' => $data]);
            return view('frontend.pages.vnpay.index', compact('tst_total_money'));
        }
    }

    public function success()
    {
        $cart = \Cart::content();
        $total = \Cart::subtotal(0);
        $viewData = [
            'cart' => $cart,
            'total' => $total,
            'title_page' => 'Cảm ơn bạn đã tin tưởng bên mình',
        ];
        return view('frontend.pages.shopping.success', $viewData);
    }

    public function delete_all_shopping()
    {
        \Cart::destroy();
    }

    public function createPayment(Request $request)
    {
        // dd($request->all());
        $vnp_TxnRef = rand(111111111, 999999999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = str_replace(',', '', \Cart::subtotal(0)) * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $vnp_TmnCode = env('VNP_TMNCODE');
        $vnp_Returnurl = route('shopping.payment.online.return');
        $vnp_Url = env('VNP_URL');
        $vnp_HashSecret = env('VNP_HASHSECRET');

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        // $returnData = array('code' => '00'
        //     , 'message' => 'success'
        //     , 'data' => $vnp_Url);
        // echo json_encode($returnData);

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        // dd($request->all());
        if (session()->has('data_customer') && $request->vnp_ResponseCode == '00') {
            DB::beginTransaction();
            try {
                $data_vnpay = $request->all();
                $data_customer = session()->get('data_customer');
                // dd($data_customer);
                $transaction = Transaction::create($data_customer);
                $shopping = \Cart::content();

                $shopping = \Cart::content();

                foreach ($shopping as $key => $item) {
                    // luu chitietdonhang
                    Order::create([
                        'od_transaction_id' => $transaction->id,
                        'od_product_id' => $item->id,
                        'od_sale' => $item->options->sale,
                        'od_qty' => $item->qty,
                        'od_price' => $item->price,
                    ]);
                    //pro_pay luot mua
                    DB::table('products')->where('id', $item->id)->increment('pro_pay', $item->qty);
                    // DB::table('products')->where('id',$item->id)->decrement('pro_number',$item->qty);
                }
                $dataMessage = [
                    'name' => $data_customer['tst_name'],
                    'message' => 'Vừa mua sản phẩm.',
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ];
                $dataPayment = [
                    'p_transaction_id' => $transaction->id,
                    'p_transaction_code' => $data_vnpay['vnp_TxnRef'],
                    'p_user_id' => $data_customer['tst_user_id'],
                    'p_money' => $data_customer['tst_total_money'],
                    'p_note' => $data_vnpay['vnp_OrderInfo'],
                    'p_vnp_response_code' => $data_vnpay['vnp_ResponseCode'],
                    'p_code_vnp' => $data_vnpay['vnp_TransactionNo'],
                    'p_code_bank' => $data_vnpay['vnp_BankCode'],
                    'p_time' => date('Y-m-d H:i', strtotime($data_vnpay['vnp_PayDate'])),
                ];
                // dd($dataPayment);

                Payment::create($dataPayment);
                event(new NotificationEvent($dataMessage));
                Mail::to($data_customer['tst_email'])->send(new TransactionSuccess($shopping, $data_customer['tst_name']));
                DB::commit();

                return redirect()->route('get.success.list')->with([
                    'success' => 'ok',
                    'email' => $data_customer['tst_email'],
                    'address' => $data_customer['tst_address'],
                    'name' => $data_customer['tst_name'],
                    'phone' => $data_customer['tst_phone'],
                    'tt' => 'Thanh Toán Qua VNPAY-QR-CODE',
                ]);

            } catch (\Exception $e) {
                Log::info($e->getMessage());
                $request->session()->flash('toastr', [
                    'type' => 'warning',
                    'message' => 'lỗi không thể thanh toán !',
                ]);
                DB::rollBack();
                return redirect('/');
            }
        } else {
            $request->session()->flash('toastr', [
                'type' => 'warning',
                'message' => 'lỗi không thể thanh toán !',
            ]);
            return redirect('/');
        }
    }
}
