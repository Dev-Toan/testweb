<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class HomeController extends FrontendController
{
    public function index()
    {
        // $product = Product::with('category')->get();
        // dd($product);
        $DHCH = (int) config('contants.ID_CATEGORY_DEFAULT.DHCH');
        $KM = (int) config('contants.ID_CATEGORY_DEFAULT.KM');
        $PKDH = (int) config('contants.ID_CATEGORY_DEFAULT.PKDH');
        $STATUS_ACTIVE = (int) config('contants.STATUS.active');
        $HOT_HOT = (int) config('contants.HOT.hot');

        // lay ra 6 san pham theo đồng hồ chính hãng xắp xếp theo lượt mua
        $proPayDHCH = $this->getProPay($DHCH);

        // lay ra 6 san pham theo Kính Thời Trang xắp xếp theo lượt mua
        $proPayKTT = $this->getProPay($KM);

        // lay ra 6 san pham theo Phụ Kiện Đồng Hồ xắp xếp theo lượt mua
        $proPayPKDD = $this->getProPay($PKDH);

        // lay ra 6 san pham dang sale xăp xếp theo id mới nhất
        $proSaleAll = Product::where([['pro_sale', '>', 0], ['pro_active', '=', $STATUS_ACTIVE]])
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        // danh sách slide xắp xếp theo thứ tự sort
        $slides = Slide::where('sd_active', $STATUS_ACTIVE)
            ->orderBy('sd_sort', 'asc')
            ->get();

        $proHot = Product::where([
            'pro_active' => $STATUS_ACTIVE,
            'pro_hot' => $HOT_HOT,
        ])->orderByDesc('id')
            ->limit(5)
            ->get();

        // danh sach san pham theo category đồng hồ
        // \DB::enableQueryLog();
        // $proCate3 = Category::with([
        //     'products' => function ($q) use ($STATUS_ACTIVE) {
        //         return $q->where('pro_active', $STATUS_ACTIVE)->orderByDesc('id');
        //     }
        // ])->where('c_parent_id', $DHCH)
        //     ->limit(3)
        //     ->get();

        $proCate3 = Category::where('c_parent_id', $DHCH)->take(3)->get()->map(function($result) {
            $result->setRelation('products', $result->products->take(6));
            return $result;
        });
        // ->orderByDesc('id')
    //         return Feed::whereUserId($user_id)->take(10)->get()->map(function($feed) {
    //             $feed->setRelation('comments', $feed->comments->take(5));
    //             return $feed;
    //    });
            // dd(\DB::getQueryLog());
        // dd($proCate3);

        // ->sortByDesc('id'))
        // ->where('pro_active',$STATUS_ACTIVE)

        // lấy ra image đồng hồ có
        $imageCate = Category::where([['c_status', '=', $STATUS_ACTIVE], ['c_parent_id', '>', 0]])
            ->limit(6)->get();

        // $event1 = Event::where('e_position_1', 1)->first();

        $typeproducts = TypeProduct::where('tp_hot', $HOT_HOT)->get();

        $productNews = Product::whereMonth('created_at', date('m'))->where('pro_active', $STATUS_ACTIVE)->take(2)->orderBy('created_at', 'DESC')->get();

        // dd($productNews);


        $viewData = [
            'proHot' => $proHot,
            'title_page' => env('APP_NAME'),
            'slides' => $slides,
            // 'event1'        => $event1,
            'proPayDHCH' => $proPayDHCH,
            'proPayKTT' => $proPayKTT,
            'proPayPKDD' => $proPayPKDD,
            'proSaleAll' => $proSaleAll,
            'proCate3' => $proCate3,
            'imageCate' => $imageCate,
            'typeproducts' => $typeproducts,
            'productNews' => $productNews,
        ];
        return view('frontend.pages.home.index', $viewData);
    }

    public function getProPay($idcate)
    {
        $STATUS_ACTIVE = (int) config('contants.STATUS.active');
        $categoryok = Category::where('c_parent_id', $idcate)
            ->where('c_status', $STATUS_ACTIVE)
            ->pluck('id')
            ->push($idcate)
            ->all();
        $pro = Product::whereIn('pro_category_id', $categoryok)
            ->where('pro_active', $STATUS_ACTIVE)
            ->orderByDesc('pro_pay')->limit(6)->get();
        return $pro;
    }

    public function search(Request $request)
    {
        $paramAtbSearch = $request
            ->except('price', 'page', 'search', 'country', 'sort');
        $paramAtbSearch = array_values($paramAtbSearch);

        // $arraySlug = explode('-', $slug);
        // $idCategory = array_pop($arraySlug);

        // tim kiem danh muc theo id đã cắt ở trên idCategory
        // $category_check = Category::with('parent', 'children', 'typeproducts', 'products.images')
        //     ->find($idCategory);
        // dd($category_check);
        // check xem nó thuốc danh mục cha nào
        // if ($category_check->c_parent_id > 0) {
        // đưa ra các type_pro (đồng hồ nam nữ,....)
        // $type_products = TypeProduct::with('product')->where('tp_category_id', $category_check->c_parent_id)->get();
        // đưa ra các ảnh của danh muc con
        // $category_Images = Category::where('c_parent_id', $category_check->c_parent_id)->get();
        //
        // $attributes = Attribute::query()->select('id', 'atb_name', 'atb_slug', 'atb_type')->where('atb_category_id', $category_check->c_parent_id)->get();
        // $attributes = $this->syncAttributeGroup($attributes);
        // } else {
        // $type_products = TypeProduct::with('product')->where('tp_category_id', $idCategory)->get();
        // $category_Images = Category::where('c_parent_id', $idCategory)->get();

        // $attributes = Attribute::query()->select('id', 'atb_name', 'atb_slug', 'atb_type')->where('atb_category_id', $idCategory)->get();
        // $attributes = $this->syncAttributeGroup($attributes);
        // }

        $type_products = TypeProduct::with('product')->get();
        $category_Images = Category::select('id', 'c_name', 'c_slug', 'c_parent_id', 'c_avatar')->where('c_status', (int) config('contants.STATUS.active'))->get();
        $attributes = Attribute::query()->select('id', 'atb_name', 'atb_slug', 'atb_type')->get();
        $attributes = $this->syncAttributeGroup($attributes);

        // $categorySearch = Category::where('c_parent_id', $idCategory)
        //     ->pluck('id')
        //     ->push($idCategory)
        //     ->all();
        // dd($categorySearch);

        // lấy ra sản phẩm
        $products = Product::query();
        if ($request->search) {
            $products->where('pro_name', 'like', '%' . $request->search . '%')->orWhere('pro_price', 'like', '%' . $request->search . '%');
        }
        // loc theo giá
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case 1:
                    $products->where('pro_price', '>', '40000000');
                    break;
                case 2:
                    $products->where('pro_price', '<', '2500000');
                    break;
                case 5:
                    $products->whereBetween('pro_price', [2500000, 5000000]);
                    break;
                case 10:
                    $products->whereBetween('pro_price', [5000000, 10000000]);
                    break;
                case 20:
                    $products->whereBetween('pro_price', [10000000, 20000000]);
                    break;
                case 40:
                    $products->whereBetween('pro_price', [20000000, 40000000]);
                    break;
            }
        }

        //lọc theo quốc gia
        if ($request->country) {
            $products->where('pro_country', $request->country);
        }
        // lọc theo attribute
        if (!empty($paramAtbSearch[0])) {
            $products->whereHas('attributes', function ($query) use ($paramAtbSearch) {
                $query->whereIn('ap_attribute_id', $paramAtbSearch);
            });
        }
        // sắp xếp
        if ($request->sort) {

            $sort = $request->sort;
            switch ($sort) {
                case 1:
                    $products->orderBy('id', 'DESC');
                    break;
                case 2:
                    $products->orderBy('pro_price', 'ASC');
                    break;
                case 3:
                    $products->orderBy('pro_price', 'DESC');
                    break;
            }
        }


        $modelProduct = new Product();

        $products = $products->where('pro_active', 1)->orderBy('id', 'DESC')->paginate((int) config('contants.PER_PAGE_DEFAULT_ADMIN'));
        // dd($products);
        $viewData = [
            // 'category_check'    => $category_check,
            'products' => $products,
            'attributes' => $attributes,
            'type_products' => $type_products,
            'category_Images' => $category_Images,
            'country' => $modelProduct->country,
            'query' => $request->query(),
            'link_search' => request()->fullUrlWithQuery(['search' => \Request::get('search')]),

        ];

        return view('frontend.pages.search.index', $viewData);
    }
}
