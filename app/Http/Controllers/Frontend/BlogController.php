<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;

class BlogController extends BlogBaseController
{
    public function index(Request $request, $slug)
    {
        $arraySlug = explode('-', $slug);
        $id = array_pop($arraySlug);

        $titleMenu = Menu::findOrfail($id);
        $menus = Menu::where('mn_status', 1)->get();
        $articles   = Article::with('menu')
            ->where([
                'a_active'  => 1,
                'a_menu_id' => $id
            ])
            ->select('id', 'a_name', 'a_slug', 'a_description', 'a_avatar', 'created_at', 'a_menu_id')
            ->orderByDesc('id')
            ->paginate(10);

        // kế thừa ở bên BlogBaseController
        $articlesHot = $this->articlesHot();
        $questionArticle = $this->questionArticle();

        $viewData = [
            'articles'          => $articles,
            'menus'             => $menus,
            'articlesHot'        => $articlesHot,
            'questionArticle'   => $questionArticle,
            'titleMenu'         => $titleMenu

        ];
        return view('frontend.pages.article.index', $viewData);
    }
}
