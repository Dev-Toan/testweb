<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserFavouriteController extends Controller
{
    public function index()
    {
        $userID = Auth::id();
        $products = Product::with('category')
            ->whereHas('favourite', function ($query) use ($userID) {
                $query->where('uf_user_id', $userID);
            })->select('id', 'pro_name', 'pro_slug', 'pro_avatar', 'pro_price', 'pro_sale', 'pro_category_id', 'pro_hot', 'created_at')
            ->paginate(10);

        $viewData = [
            'products'    => $products
        ];
        return view('frontend.user.favourite', $viewData);
    }

    public function addFavourite(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::find($id);
            if (!$product) return response(['messages' => 'Không Tồn Tại Sản Phẩm']);
            $messages = 'Thêm Yêu Thích Thành Công !';
            try {
                DB::table('user_favourite')->insert([
                    'uf_product_id'     => $id,
                    'uf_user_id'        => Auth::id()
                ]);
            } catch (\Throwable $e) {
                $messages = 'Sản Phẩm này đã được yêu thích !';
                return response([
                    'messages' => $messages,
                    'code' => 400,
                    'error' => $e->getMessage()
                ]);
            }

            return response([
                'messages' => $messages,
                'code' => 200
            ]);
        }
    }
}
