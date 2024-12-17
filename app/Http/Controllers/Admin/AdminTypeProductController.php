<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminTypeProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminTypeProductController extends Controller
{
    public function index()
    {
        $type_products = TypeProduct::with('category:id,c_name')->orderBy('id', 'DESC')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
        return view('admin.typeproduct.index', compact('type_products'));
    }

    public function create()
    {
        $categories = Category::where('c_parent_id', 0)->get();
        return view('admin.typeproduct.create', compact('categories'));
    }

    public function store(AdminTypeProductRequest $request)
    {
        $data                   = $request->except('_token', 'tp_avatar');
        $data['tp_slug']         = Str::slug($request->tp_name);

        if ($request->tp_avatar) {
            $image = upload_image('tp_avatar');
            if ($image['code'] == 1) {
                $data['tp_avatar'] = $image['name'];
            }
        }
        TypeProduct::create($data);

        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Insert thành công !'
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $categories = Category::where('c_parent_id', 0)->get();
        $type_product = TypeProduct::findOrfail($id);
        return view('admin.typeproduct.update', compact('categories', 'type_product'));
    }

    public function update(AdminTypeProductRequest $request, $id)
    {
        $type_product = TypeProduct::findOrfail($id);
        $data                   = $request->except('_token', 'tp_avatar');
        $data['tp_slug']         = Str::slug($request->tp_name);

        if ($request->tp_avatar) {
            $image = upload_image('tp_avatar');
            if ($image['code'] == 1) {
                $data['tp_avatar'] = $image['name'];
            }
        }

        $type_product->update($data);
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Update thành công !'
        ]);
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $type_product = TypeProduct::findOrfail($id);
        $product = Product::query()->where('pro_type_product_id', $id)->first();
        if ($product) {
            $request->session()->flash('toastr', [
                'type'      => 'warning',
                'message'   => 'Có sản phẩm phụ thuộc không thể xóa !'
            ]);
            return redirect()->back();
        }
        if ($type_product) {
            $type_product->delete();
            $request->session()->flash('toastr', [
                'type'      => 'success',
                'message'   => 'Delete thành công !'
            ]);
        }
        return redirect()->back();
    }

    public function hot(Request $request, $id)
    {
        $type_product           = TypeProduct::findOrfail($id);
        $type_product->tp_hot = !$type_product->tp_hot;
        $type_product->updated_at = Carbon::now();
        $type_product->save();

        if ($request->ajax()) {
            $type_products     = TypeProduct::orderBy('id', 'DESC')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
            $query  = $request->query();
            $html = view('admin.typeproduct.data', compact('type_products', 'query'))->render();
            return response([
                'data'      => $html ?? null,
                'messages'  => 'Update hot thành công !'
            ]);
        }
        return redirect()->back();
    }

    public function active(Request $request, $id)
    {
        $product = Product::query()->where('pro_type_product_id', $id)->first();
        if ($product) {
            return response([
                'error'      => 'error',
                'messages'   => 'Đang có sản phẩm phụ thuộc không thể ẩn !'
            ]);
        }
        $type_product           = TypeProduct::findOrfail($id);
        $type_product->tp_status = !$type_product->tp_status;
        $type_product->updated_at = Carbon::now();
        $type_product->save();

        if ($request->ajax()) {
            $type_products     = TypeProduct::orderBy('id', 'DESC')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
            $query  = $request->query();
            $html = view('admin.typeproduct.data', compact('type_products', 'query'))->render();
            return response([
                'data'      => $html ?? null,
                'messages'  => 'Update status thành công !'
            ]);
        }
        return redirect()->back();
    }
}
