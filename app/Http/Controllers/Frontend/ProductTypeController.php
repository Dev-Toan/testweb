<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;

class ProductTypeController extends FrontendController
{
    public function index(Request $request, $slug)
    {
        $paramAtbSearch = $request->except('price', 'page', 'search', 'country', 'sort');
        $paramAtbSearch = array_values($paramAtbSearch);

        // cắt lấy id của TypeProduct
        $arraySlug = explode('-', $slug);
        $idTypePro = array_pop($arraySlug);

        // tìm ra type_product
        $typeProduct = TypeProduct::findOrfail($idTypePro);

        // lấy ra id của category
        $idCategory = $typeProduct->tp_category_id;

        // tim kiem danh muc theo id đã cắt ở trên idCategory
        $category_check = Category::with('parent')->find($idCategory);

        // check xem nó thuốc danh mục cha nào
        if ($category_check->c_parent_id > 0) {
            // đưa ra các type_pro (đồng hồ nam nữ,....)
            $type_products = TypeProduct::with('product')->where('tp_category_id', $category_check->c_parent_id)->get();
            // đưa ra các ảnh của danh muc con
            $category_Images = Category::where('c_parent_id', $category_check->c_parent_id)->get();

            $attributes = Attribute::query()->select('id', 'atb_name', 'atb_slug', 'atb_type')->where('atb_category_id', $category_check->c_parent_id)->get();
            $attributes = $this->syncAttributeGroup($attributes);
        } else {
            $type_products = TypeProduct::with('product')->where('tp_category_id', $idCategory)->get();
            $category_Images = Category::where('c_parent_id', $idCategory)->get();

            $attributes = Attribute::query()->select('id', 'atb_name', 'atb_slug', 'atb_type')->where('atb_category_id', $idCategory)->get();
            $attributes = $this->syncAttributeGroup($attributes);
        }

        // lấy ra sản phẩm
        $products = Product::where('pro_type_product_id', $idTypePro);

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
        if (!empty($paramAtbSearch)) {
            $products->whereHas('attributes', function ($query) use ($paramAtbSearch) {
                $query->whereIn('ap_attribute_id', $paramAtbSearch);
            });
        }

        // if($request->search){
        //     $products->where('pro_name','like','%'.$request->search.'%');
        // }

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

        // if (!empty($paramAtbSearch)) {
        //     foreach ($paramAtbSearch as $key => $value) {
        //         $products->whereHas('attributes', function ($query) use ($value) {
        //             $query->where('ap_attribute_id', (int)$value);
        //         });
        //     }
        // }

        $modelProduct = new Product();

        $products = $products->where('pro_active', 1)->paginate(10);

        $viewData = [
            'category_check'    => $category_check,
            'typeProduct'       => $typeProduct,
            'attributes'        => $attributes,
            'products'          => $products,
            'type_products'     => $type_products,
            'category_Images'   => $category_Images,
            'country'           => $modelProduct->country,
            'query'             => $request->query(),
            'link_search'       => request()->fullUrlWithQuery(['search' => \Request::get('search')]),


        ];
        return view('frontend.pages.product.index', $viewData);
    }
}
