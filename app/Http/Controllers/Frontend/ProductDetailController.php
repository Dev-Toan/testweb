<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use App\Http\Services\ProcessViewService;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $arraySlug = explode('-', $slug);
        $id = array_pop($arraySlug);

        if ($id) {
            // lấy ra product theo id đã cắt ở trên
            // và kết nối theo category để lấy ra các danh mục
            $product = Product::with('category', 'attributes', 'category.parent', 'typeproduct.product', 'images')->findOrfail($id);

            // lấy ra các ảnh của danh mục nó thuộc về
            $imagesType = TypeProduct::where([
                ['tp_category_id', '=', $product->category->c_parent_id],
                ['tp_status', '=', 1]
            ])->get();

            // tăng view ở fodel Services
            ProcessViewService::view('products', 'pro_view', 'product', $id);



            // lấy ra sản phẩm suggets
            $productSuggests = $this->getProductSuggests($product->pro_category_id);

            // lấy ra tin tức sự kiện
            // $articles = Article::where([
            //         'a_active'  =>1,
            //     ])->orderBy('id', 'DESC')->limit(3)->get();

            // lấy ra đánh giá ở trang detail sản phẩm
            $ratings = Rating::with('user:id,name')
                ->where([
                    'r_product_id'  => $id,
                    'r_status'      => 1
                ])->orderByDesc('id')
                ->limit(5)
                ->get();

            $ratingsDashboard = Rating::groupBy('r_number')
                ->where('r_product_id', $id)
                ->select(DB::raw('count(r_number) as count_number'), DB::raw('sum(r_number) as total'))
                ->addSelect('r_number')
                ->get()->toArray();

            $ratingDefault = $this->mapRatingDefault();
            // dd($ratingDefault);

            foreach ($ratingsDashboard as $key => $value) {
                $ratingDefault[$value['r_number']] = $value;
            }

            $viewData = [
                'product'               => $product,
                'ProductsSuggests'      => $this->getProductSuggests($product->pro_category_id),
                'title_page'            => $product->category->c_name . '-' . $product->pro_name,
                'ratingsDashboard'      => $ratingsDashboard,
                'imagesType'            => $imagesType,
                'ratingDefault'         => $ratingDefault,
                'productSuggests'       => $productSuggests,
                // 'articles'              => $articles,
                'ratings'               => $ratings
            ];
            return view('frontend.pages.product_detail.index', $viewData);
        }
        return redirect()->to('/');
    }

    // líst danh gia san pham
    public function getListRatingProduct(Request $request, $slug)
    {
        $arraySlug = explode('-', $slug);
        $id = array_pop($arraySlug);

        if ($id) {
            //1
            $product = Product::with('category:id,c_name,c_slug,c_parent_id', 'category.parent')->findOrfail($id);
            //2
            $ratings = Rating::with('user:id,name')
                ->where([
                    'r_product_id'  => $id,
                    'r_status'      => 1
                ]);

            if ($request->s) {
                $ratings->where('r_number', $request->s);
            }

            $ratings = $ratings->orderByDesc('id')->paginate(4);
            // dd($ratings);

            if ($request->ajax()) {
                $query  = $request->query();
                $html   = view('frontend.pages.product_detail.include._inc_list_reviews', compact('ratings', 'query'))->render();
                return response(['data' => $html]);
                // \Log::info($html);
            }
            //3
            $ratingsDashboard = Rating::groupBy('r_number')
                ->where('r_product_id', $id)
                ->select(DB::raw('count(r_number) as count_number'), DB::raw('sum(r_number) as total'))
                ->addSelect('r_number')
                ->get()->toArray();
            $ratingDefault = $this->mapRatingDefault();
            foreach ($ratingsDashboard as $key => $value) {
                $ratingDefault[$value['r_number']] = $value;
            }

            $viewData = [
                'product'   => $product,
                'ratings'   => $ratings,
                'ratingDefault' => $ratingDefault,
                'query'     => $request->query()
            ];
            return view('frontend.pages.product_detail.product_ratings', $viewData);
        }
        return redirect()->to('/');
    }
    private function mapRatingDefault()
    {
        $ratingDefault = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDefault[$i] = [
                'count_number'  => 0,
                'total'         => 0,
                'r_number'      => 0
            ];
        }
        return $ratingDefault;
    }

    private function getProductSuggests($categoriID)
    {
        $products = Product::with('typeproduct:id,tp_name')->where([
            'pro_active' => 1,
            'pro_category_id' => $categoriID
        ])->orderByDESC('id')
            ->select('id', 'pro_name', 'pro_slug', 'pro_sale', 'pro_avatar', 'pro_price', 'pro_type_product_id')
            ->limit(3)
            ->get();
        return $products;
    }
}
