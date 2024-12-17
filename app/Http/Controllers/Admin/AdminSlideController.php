<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Http\Requests\AdminSlideRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminSlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderByDesc('id')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
        return view('admin.slide.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slide.create');
    }

    public function store(AdminSlideRequest $request)
    {
        $data = $request->except('_token', 'sd_image');
        if ($request->sd_image) {
            $image = upload_image('sd_image');
            if ($image['code'] == 1) {
                $data['sd_image'] = $image['name'];
            }
        }
        $slide = Slide::create($data);
        return redirect()->back();
    }

    public function edit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.update', compact('slide'));
    }

    public function update(AdminSlideRequest $request, $id)
    {
        $slide      = Slide::find($id);
        $data       = $request->except('_token', 'sd_image');
        if ($request->sd_image) {
            $image = upload_image('sd_image');
            if ($image['code'] == 1) {
                $data['sd_image'] = $image['name'];
            }
        }
        $update = $slide->update($data);

        return redirect()->back();
    }

    public function active(Request $request, $id)
    {
        $slide           = Slide::findOrfail($id);
        $slide->sd_active = !$slide->sd_active;
        $slide->updated_at = Carbon::now();
        $slide->save();

        if ($request->ajax()) {
            $slides     = Slide::orderBy('id', 'DESC')->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
            $query  = $request->query();
            $html = view('admin.slide.data', compact('slides', 'query'))->render();
            return response([
                'data'      => $html ?? null,
                'messages'  => 'Update status thành công !'
            ]);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        $slide      = Slide::find($id);
        if ($slide) {
            $slide->delete();
        }
        return redirect()->back();
    }
}
