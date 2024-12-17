<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAttributeRequest;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminAttributeController extends Controller
{
    public function index()
    {
        $attribute = Attribute::with('category:id,c_name')->orderBydesc('id')->get();
        $viewData = [
            'attribute' => $attribute
        ];
        return view('admin.attribute.index', $viewData);
    }

    public function create()
    {
        $category = Category::where('c_parent_id', 0)->get();
        $arrType = new Attribute();
        // foreach($arrType->getType() as $key=> $item){
        //     dd($item['name']);
        // }
        $viewData = [
            'category' => $category,
            'arrType' => $arrType
        ];
        return view('admin.attribute.create', $viewData);
    }

    public function store(AdminAttributeRequest $request)
    {
        // Attribute::create($request->only('atb_name'));
        $data = $request->except('_token');
        $data['atb_slug'] = Str::slug($request->atb_name);

        Attribute::create($data);

        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Insert thành công !'
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $category = Category::where('c_parent_id', 0)->get();
        $attribute = Attribute::find($id);
        $arrType = new Attribute();
        $viewData = [
            'category'  => $category,
            'attribute' => $attribute,
            'arrType' => $arrType
        ];
        return view('admin.attribute.update', $viewData);
    }

    public function update(AdminAttributeRequest $request, $id)
    {
        $attribute = Attribute::findOrfail($id);
        $data = $request->except('_token');
        $data['atb_slug'] = Str::slug($request->atb_name);

        $attribute->update($data);
        $request->session()->flash('toastr', [
            'type'      => 'success',
            'message'   => 'Update thành công !'
        ]);
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $attribute = Attribute::with('products:id,pro_name')->where('id', $id)->first();
        if (!empty($attribute->products[0])) {
            $request->session()->flash('toastr', [
                'type'      => 'warning',
                'message'   => 'Có sản phẩm phụ thuộc nên không thể xóa !'
            ]);
            return redirect()->back();
        }
        if ($attribute) {
            $attribute->delete();
            $request->session()->flash('toastr', [
                'type'      => 'success',
                'message'   => 'Delete thành công !'
            ]);
        }
        return redirect()->back();
    }
}
