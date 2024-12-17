<div class="item">
    <div class="wImage">
        <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" title="" class="image cover">
        <img data-src="{{ pare_url_file($item->a_avatar) }}" alt="tin tuc" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
        </a>
    </div>
    <div class="info">
        <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" title="" class="name">
            <h3>{{ $item->a_name }}</h3>
        </a>
        <h3 class="cont dotdotdot">
            {{ $item->a_description }}
        </h3>
    </div>
</div>
