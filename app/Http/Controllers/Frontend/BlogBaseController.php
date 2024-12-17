<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;

class BlogBaseController extends Controller
{
    public function getIndex(Request $request)
    {

        $menus = Menu::where('mn_status', config('contants.STATUS.active'))->get();

        $titleMenu = Menu::findOrfail(config('contants.DEFAULT_MENU.default'));

        $articles   = Article::with('menu')
            ->where([
                'a_active'  => 1,
                'a_menu_id' => 1
            ])
            ->select('id', 'a_name', 'a_slug', 'a_description', 'a_avatar', 'created_at', 'a_menu_id')
            ->orderByDesc('id')
            ->paginate(10);


        $articlesHot = $this->articlesHot();
        $questionArticle = $this->questionArticle();

        $viewData = [
            'articles'          => $articles,
            'menus'             => $menus,
            'articlesHot'       => $articlesHot,
            'questionArticle'   => $questionArticle,
            'titleMenu'         => $titleMenu
        ];
        return view('frontend.pages.article.index', $viewData);
    }
    public function articlesHot()
    {
        $articlesHot = Article::where([
            'a_active'  => config('contants.STATUS.active'),
            'a_hot'     => config('contants.HOT.hot'),
        ])->select('id', 'a_name', 'a_slug', 'a_description', 'a_avatar', 'created_at')
            ->orderByDesc('id')
            ->get(3);
        return $articlesHot;
    }
    public function questionArticle()
    {
        $questionArticle = Article::where([
            'a_active'  => config('contants.STATUS.active'),
            'a_menu_id' => 3
        ])->select('id', 'a_name', 'a_slug', 'a_description', 'a_avatar', 'created_at')
            ->orderByDesc('id')
            ->get(3);
        return $questionArticle;
    }
}
