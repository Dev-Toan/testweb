<div class="right">
    <div class="newsRight1">
        <a href="javascript://" title="Hỏi đáp về đồng hồ" class="title">Hỏi đáp về giày</a>
        <ul>
            @php
                $i = 1;
            @endphp
        @foreach ($questionArticle as $item)
            <li>
                <span class="stt">{{ $i++ }}</span>
                <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" title="{{ $item->a_name }}">{{ $item->a_name }}</a>
            </li>
        @endforeach
        </ul>
    </div>
    <div class="newsRight2">
        <a href="#" title="" class="title">Tin tức nổi bật</a>
        <div class="group">
        @foreach ($articlesHot as $item)
            <div class="item">
                <div class="wImage">
                    <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" title="{{ $item->a_name }}" class="image cover">
                    <img data-src="{{ pare_url_file($item->a_avatar) }}" alt="tin tuc" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </a>
                </div>
                <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" title="" class="name">{{ $item->a_name }}</a>
            </div>
        @endforeach
        </div>
    </div>
</div>
