<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index()
    {
        $user = User::paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
        $viewData = [
            'user'  => $user
        ];
        return view('admin.user.index', $viewData);
    }
    public function delete(Request $request, $id)
    {
        $user = User::with('ratings')->find($id);
        if ($user) {
            if ($user->role == \config('contants.ROLE.ADMIN') && $user->id == 1) {
                $request->session()->flash('toastr', [
                    'type'      => 'error',
                    'message'   => 'Không thể xóa Supper Admin !'
                ]);
                return redirect()->back();
            }
            $transaction = Transaction::where('tst_user_id', $id)->first();
            if ($transaction) {
                $request->session()->flash('toastr', [
                    'type'      => 'error',
                    'message'   => 'Khách hàng đang có đơn hàng !'
                ]);
                return redirect()->back();
            }
            DB::beginTransaction();
            try {
                foreach ($user->ratings as $item) {
                    $product = Product::find($item->r_product_id);
                    $product->pro_review_total--;
                    $product->pro_review_star -= $item->r_number;
                    $product->save();

                    $item->delete();
                }
                $user->delete();
            } catch (\Exception $e) {
                DB::rollBack();
                $request->session()->flash('toastr', [
                    'type'      => 'error',
                    'message'   => 'loi xay ra vui long goi admin !'
                ]);
            }
        };
        DB::commit();
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Xóa user thành công !'
        ]);
        return redirect()->back();
    }
}
