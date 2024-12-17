<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;

class ArticleDetailController extends BlogBaseController
{
    public function index(Request $request, $slug)
    {
        $arraySlug = explode('-', $slug);
        $id = array_pop($arraySlug);
        if ($id) {
            $article = Article::with('menu')->findOrfail($id);
            $menus = Menu::where('mn_status', 1)->get();

            $suggestsArticle = Article::where([
                'a_active'  => 1,
                'a_menu_id' => $article->a_menu_id
            ])->orderByDesc('id')->limit(5)->get();

            // kế thừa ở bên BlogBaseController
            $articlesHot = $this->articlesHot();
            $questionArticle = $this->questionArticle();

            $viewData = [
                'article'           => $article,
                'menus'             => $menus,
                'articlesHot'       => $articlesHot,
                'questionArticle'   => $questionArticle,
                'suggestsArticle'   => $suggestsArticle
            ];
            return view('frontend.pages.article_detail.index', $viewData);
        }

        return redirect()->to('/');
    }
}
