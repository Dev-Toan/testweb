@extends('layout.master_frontend')
@section('content')
<div id="pageway" style="border-bottom: 5px solid #e5e5e5;">
    <div class="wrp">
        <ul>
            <li><a href="/" title="Home"><b>TRANG CHỦ</b></a></li>
            <li><a href="javascript://" title="Tin Dong ho"><b>{{ $titleMenu->mn_name }}</b></a></li>
        </ul>
    </div>
</div>
<div class="cb"></div>

<div id="container">
    <div class="wrp">
        <div id="newslist">
            <ul class="lstCate">
            <!-- @foreach ($menus as $item)
                <li class="active" style="margin-left: 25px;"><a href="{{ route('get.blog.index',$item->mn_slug.'-'.$item->id) }}" title="{{ $item->mn_name }}">{{ $item->mn_name }}</a></li>
            @endforeach -->
            </ul>
            <div class="flex">
                <div class="left">
                    <div class="group">
                    @foreach ($articles as $item)
                        @include('frontend.pages.article.include.inc_blog_item',['item'=>$item])
                    @endforeach
                    </div>
                    <nav class="text-center" style="width:100%;text-align:center;padding-top: 15px;">
                        <span class="paging_div">

                        </span>
                    </nav>
                </div>
                @include('frontend.pages.article.include.inc_right',['questionArticle'=>$questionArticle,'articlesHot'=>$articlesHot])
            </div>
            <div class="cb"></div>
        </div>
    </div>
</div>

@endsection
