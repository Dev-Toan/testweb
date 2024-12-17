@extends('layout.master_frontend')
@section('content')

<div id="pageway" style="border-bottom: 5px solid #e5e5e5;">
    <div class="wrp">
        <ul>
            <li><a href="/" title="Home"><b>TRANG CHỦ</b></a></li>
            <li><a href="{{ route('get.blog.index', $article->menu->mn_slug.'-'. $article->menu->id) }}" title="{{ $article->menu->mn_name }}"><b>{{ $article->menu->mn_name }}</b></a></li>
            <li><a href="javascript://" title="{{ $article->a_name }}" style="color: #288ad6">{{ $article->a_name }}</a></li>
        </ul>
    </div>
</div>
<div class="cb"></div>
<div id="container">
    <div class="wrp">
        <div id="newslist">
            <ul class="lstCate">
                @foreach ($menus as $item)
                <li class="active" style="margin-left: 25px;"><a href="{{ route('get.blog.index',$item->mn_slug.'-'.$item->id) }}" title="{{ $item->mn_name }}">{{ $item->mn_name }}</a></li>
            @endforeach
            </ul>
            <div class="flex">
                <div class="left">
                    <h1 class="titleNews">{{ $article->a_name }}</h1>
                    <h2 class="sapo">{{ $article->a_description }}</h2>
                    <div class="noidung">
                        {!! $article->a_content !!}
                    </div>
                    <div class="cb"></div>
                    <div class="other" style="padding-top: 20px;">
                        <p class="title">Bài viết khác</p>
                        <ul>
                        @foreach ($suggestsArticle as $item)
                            <li> <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" title="{{ $item->a_name }}">{{ $item->a_name }}</a></li>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                @include('frontend.pages.article.include.inc_right',['questionArticle'=>$questionArticle,'articlesHot'=>$articlesHot])
            </div>
        </div>
        <div class="cb"></div>
    </div>
</div>
@endsection
