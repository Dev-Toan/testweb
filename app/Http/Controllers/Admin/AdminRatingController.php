<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRatingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('r_status')) {
                $id = $request->r_id;
                $rating = Rating::find($id);
                if ($request->r_status == 1) {
                    $rating->r_status = 0;
                    $rating->save();
                }
                if ($request->r_status == 2) {
                    $rating->r_status = 1;
                    $rating->save();
                }
            }

            $ratings     = Rating::with('product:id,pro_name,pro_slug', 'user:id,name')
                ->orderBy('id', 'DESC')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
            $query  = $request->all();
            $html = view('admin.rating.data', compact('ratings', 'query'))->render();
            return response([
                'data'      => $html ?? null,
                'query' => $request->query()
            ]);
        }
        $query = $request->query();
        $ratings = Rating::with('product:id,pro_name,pro_slug', 'user:id,name')
            ->orderByDesc('id')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
        $viewData = [
            'ratings'   => $ratings,
            'query' => $query
        ];
        return view('admin.rating.index', $viewData);
    }

    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        $rating = Rating::find($id);
        if ($rating) {
            try {
                $product = Product::find($rating->r_product_id);
                $product->pro_review_total--;
                $product->pro_review_star -= $rating->r_number;
                $product->save();

                $rating->delete();
                DB::commit();
                $request->session()->flash('toastr', [
                    'type'      => 'success',
                    'message'   => 'delete thành công !'
                ]);
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
        $request->session()->flash('toastr', [
            'type'      => 'error',
            'message'   => 'Không tồn tại rating !'
        ]);
        return redirect()->back();
    }

    public function active(Request $request, $id)
    {
        $rating = Rating::find($id);
        $rating->r_status = !$rating->r_status;
        $rating->save();

        if ($request->ajax()) {
            $ratings     = Rating::orderBy('id', 'DESC')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'))->withQueryString();
            $query  = $request->all();
            $html = view('admin.rating.data', compact('ratings', 'query'))->render();
            return response([
                'data'      => $html ?? null,
                'messages'  => 'Update status thành công !',
                'query' => $ratings
            ]);
        }
        return redirect()->back();
    }

    public function viewDetail(Request $request, $id)
    {
        if ($request->ajax()) {
            $rating = Rating::find($id);
            $html = view('admin.rating.data_view', compact('rating'))->render();
            return response([
                'data' => $html ?? null,
                'messages' => 'oke !',
            ]);
        }
        return redirect()->back();
    }
}
