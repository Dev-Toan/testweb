<div class="item">
    <div class="wImage">
        <a href="{{ route('get.product.detail',$item->pro_slug.'-'.$item->id) }}" title="{{ $item->pro_name }}" class="image">
        <img data-src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->category->c_name }}" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
        </a>
        @if ($item->pro_sale)
            <span class="top1"><span>-{{ $item->pro_sale }}%</span></span>
        @endif
    </div>
    <div class="info">
        <p>40mm | {{ $item->pro_resistant ? $item->pro_resistant : '' }} </p>
        <a href="{{ route('get.product.detail',$item->pro_slug.'-'.$item->id) }}" title="" class="name">
        {{ $item->pro_name }} - {{ $item->typeproduct->tp_name }}                                </a>
        <div class="price">
            @if ($item->pro_sale)
                @php
                    $price  =$item->pro_price * ((100-$item->pro_sale)/100);
                @endphp
                <p class="new">{{ number_format($price,0,',','.') }}đ</p>
                <p class="old">{{ number_format($item->pro_price,0,',','.') }}đ</p>
            @else
                <p class="new">{{ number_format($item->pro_price,0,',','.') }}đ</p>
            @endif
        </div>
        <div class="count">
            <div class="bg" style="width: {{ $item->pro_number ? (($item->pro_number - $item->pro_pay) * 100) / $item->pro_number : 0 }}%"></div>
            <span class="text">Còn lại {{ $item->pro_number - $item->pro_pay }}</span>
        </div>
    </div>
</div>

