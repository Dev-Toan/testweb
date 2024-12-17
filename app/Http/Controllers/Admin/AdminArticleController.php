<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestArticle;
use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('menu:id,mn_name')
            ->orderByDesc('id')
            ->paginate((int)config('contants.PER_PAGE_DEFAULT_ADMIN'));
        $viewData = [
            'articles'  => $articles
        ];

        return view('admin.article.index', $viewData);
    }
    public function create()
    {
        $menus = Menu::all();
        $viewData = [
            'menus'  => $menus
        ];

        return view('admin.article.create', $viewData);
    }
    public function store(AdminRequestArticle $request)
    {
        $data               = $request->except('_token', 'a_avatar');
        $data['a_slug']     = Str::slug($request->a_name);
        $data['created_at'] =  Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->a_avatar) {
            $image = upload_image('a_avatar');
            if ($image['code'] == 1) {
                $data['a_avatar'] = $image['name'];
            }
        }
        $id                 = Article::insertGetId($data);

        return redirect()->back();
    }
    public function edit($id)
    {
        $article        = Article::find($id);
        $menus = Menu::all();
        $viewData = [
            'article'   => $article,
            'menus'     => $menus
        ];

        return view('admin.article.update', $viewData);
    }
    public function update(AdminRequestArticle $request, $id)
    {
        $article            = Article::find($id);
        $data               = $request->except('_token', 'a_avatar');
        $data['a_slug']     = Str::slug($request->a_name);
        $data['updated_at']  = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->a_avatar) {
            $image = upload_image('a_avatar');
            if ($image['code'] == 1) {
                $data['a_avatar'] = $image['name'];
            }
        }
        $article->update($data);

        return redirect()->back();
    }
    public function active($id)
    {
        $article            = Article::find($id);
        $article->a_active  = !$article->a_active;
        $article->updated_at =  Carbon::now('Asia/Ho_Chi_Minh');
        $article->save();

        return redirect()->back();
    }
    public function hot($id)
    {
        $article            = Article::find($id);
        $article->a_hot     = !$article->a_hot;
        $article->updated_at =  Carbon::now('Asia/Ho_Chi_Minh');
        $article->save();

        return redirect()->back();
    }
    public function delete($id)
    {
        $article        = Article::find($id);
        if ($article) $article->delete();

        return redirect()->back();
    }
}
