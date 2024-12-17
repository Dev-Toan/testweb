<?php

namespace App\Http\Controllers\User;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRatingController extends Controller
{
    public function addRatingProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->except('_token');
            // \Log::info(json_encode($data));

            $rating = new Rating();
            $rating->r_user_id      = Auth::id();
            $rating->r_product_id   = $request->product_id;
            $rating->r_number       = $request->review;
            $rating->r_content      = $request->content_review;
            $rating->created_at     = Carbon::now('Asia/Ho_Chi_Minh');
            $rating->save();

            if ($rating->id) {
                $html = view('frontend.pages.product_detail.include._inc_rating_item_data', compact('rating'))->render();
                $this->staticRatingProduct($request->product_id, $request->review);
            }
            $dataMessage = [
                'name' => Auth::user()->name,
                'message' => 'Vừa comment sản phẩm.',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ];
            event(new NotificationEvent($dataMessage));
            return response([
                'html'      => $html ?? null,
                'messages'  => ' Đánh giá SP thành công !'
            ]);
        }
    }

    public function staticRatingProduct($productID, $number)
    {
        $product = Product::find($productID);
        $product->pro_review_total++;
        $product->pro_review_star += $number;
        $product->save();
    }
}
