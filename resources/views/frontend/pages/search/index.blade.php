@extends('layout.master_frontend')
@section('css')
    <style>
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination>li {
            display: inline;
        }
        .pagination .page-item {
            text-align: center;
        }
        .pagination .page-item.disabled .page-link {
            border: 0;
            display: none;
        }
        .pagination .page-item.active .page-link {
            border-color: #f4574c;
            color: #fff;
            display: block;
            padding: 0px;
            line-height: 45px;
            background: #f4574c;
            text-align: center;
        }
        .pagination .page-link {
            float: left;
            margin: 2.5px;
            width: 45px;
            text-align: center;
            height: 45px;
            font-size: 14px;
            line-height: 45px;
            font-family: 'Arial',sans-serif;
            color: #333;
            border-radius: 50% !important;
            border: solid 1px #ebebeb;
            text-decoration: none;
            padding: 0px;
            margin: 0px 2.5px;
        }
        .pagination .page-link {
            float: left;
            margin: 2.5px;
            width: 45px;
            text-align: center;
            height: 45px;
            font-size: 14px;
            line-height: 45px;
            font-family: 'Arial',sans-serif;
            color: #333;
            border-radius: 50% !important;
            border: solid 1px #ebebeb;
            text-decoration: none;
            padding: 0px;
            margin: 0px 2.5px;
        }
        .active_filter{
            color: #f76b1c;
        }
    </style>
@endsection
@section('content')

<div id="pageway">
    <div class="wrp">
        <ul>
            {{-- <li><a href="{{ route('get.category.list',$category_check->c_slug.'-'.$category_check->id) }}" title="{{ $category_check->c_name }}"><b>{{ $category_check->c_name }}</b></a></li> --}}
            @if (isset($typeProduct))
                <li><a href="{{ route('get.type.product.list',$typeProduct->tp_slug.'-'.$typeProduct->id) }}" title="{{ $typeProduct->tp_name }}" style="color: #288ad6">{{ $typeProduct->tp_name }}</a></li>
            @endif
            <li><a href="javacript://" title="" rel="nofollow">Có <span class="fRobotoB" style="color:#ff5722">{{ number_format($products->total()) }}</span> sản phẩm</a></li>
        </ul>
    </div>
</div>
<div class="cb"></div>
<div id="container">
    {{-- <div id="menuCate" class="dnTablet-l">
        <div class="wrp">
            <div class="group">

            @foreach ($type_products as $item)
                <a href="{{ route('get.type.product.list',$item->tp_slug.'-'.$item->id) }}" title="{{ $item->tp_name }}" class="item">
                    <div class="img">
                        <div class="wImage cover">
                            <span class="image">
                            <img src="{{ pare_url_file($item->tp_avatar) }}" style="display: block;">
                            </span>
                        </div>
                    </div>
                    <div class="right">
                        <h2 class="name">{{ $item->tp_name }}</h2>
                        <p class="count">Có <b>{{ $item->product->count() }}</b> sản phẩm</p>
                    </div>
                </a>
            @endforeach
            </div>
        </div>
    </div>
    <div id="countCate" class="dn dbtablet-l">
        <div class="wrp">
            <div class="group">
                @foreach ($type_products as $item)
                    <a href="{{ route('get.type.product.list',$item->tp_slug.'-'.$item->id) }}" title="{{ $item->tp_name }}" class="item">
                        <span class="ttu fRobotoB">{{ $item->tp_name }}</span>
                        <span>Có <b>{{ $item->product->count() }}</b></span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="filterLogo">
        <div class="wrp">
            <div class="group">
            @foreach ($category_Images as $item)
                <div class="img">
                    <div class="wImage">
                        <a href="{{ route('get.category.list',$item->c_slug.'-'.$item->id) }}" title="{{ $item->c_name }}" class="image">
                        <img src="{{ pare_url_file($item->c_avatar) }}" style="display: block;">
                        </a>
                    </div>
                </div>
            @endforeach

                <a href="javascript:;" class="viewMore">
                <span>Xem thêm <i class="fas fa-caret-down"></i></span>
                <span>Thu gọn <i class="fas fa-caret-up"></i></span>
                </a>
            </div>
        </div>
    </div> --}}
    <div id="product">
        <div class="wrp">
            <div class="nameCate">
                @if (isset($typeProduct))
                    <a href="{{ route('get.type.product.list',$typeProduct->tp_slug.'-'.$typeProduct->id) }}" title="{{ $typeProduct->tp_name }}" class="name">{{ $typeProduct->tp_name }} </a>
                @else
                    {{-- <a href="{{ route('get.category.list',$category_check->c_slug.'-'.$category_check->id) }}" title="{{ $category_check->c_name }}" class="name">{{ $category_check->c_name }} </a> --}}
                @endif
            </div>
            <div id="filter">
                <div class="order">
                    <div class="price">
                        <span>Giá: </span>
                        <div class="lstPrice">
                            <ul>
                                <li><a class="js-param-search  {{ Request::get('price') == 2 ? 'active_filter' : '' }}"  data-param="price=2" href="{{ request()->fullUrlWithQuery(['price'=>2]) }}" title="Dưới 205 triệu">Dưới 2.5 triệu</a></li>
                                @for($i=2.5;$i<=30;$i+=$i)
                                    <li><a class="js-param-search  {{ Request::get('price') == $i*2 ? 'active_filter' : '' }}" data-param="price={{ $i*2 }}" href="{{ request()->fullUrlWithQuery(['price'=>$i*2]) }}" title="Từ {{ $i .' - '. $i*2 }} triệu">Từ {{ $i .' - '. $i*2 }} triệu</a></li>
                                @endfor
                                <li><a class="js-param-search  {{ Request::get('price') == 1 ? 'active_filter' : '' }}" data-param="price=1" href="{{ request()->fullUrlWithQuery(['price'=>1]) }}" title="Trên 40 Triệu">Trên 40 Triệu</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="right">
                        <div class="function odering">
                            <span class="openSubOrder">Quốc Gia <i class="fas fa-caret-down"></i></span>
                            <div class="sub filter">
                                <div class="group">
                                    <ul>
                                    @foreach ($country as $key => $item)
                                        <li>
                                            <label class=" {{ Request::get('country') == $key ? 'active' : '' }}" >
                                                    <span class="check"><i class="fas fa-check"></i></span>
                                                <span><a class="js-param-search {{ Request::get('country') == $key ? 'active_filter' : '' }}"  data-param="country={{ $key }}" href="{{ request()->fullUrlWithQuery(['country' => $key]) }}" title="{{ $item }}">{{ $item }}</a></span>
                                            </label>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                                <a href="javascript://" class="closeSub"><i class="far fa-times-circle"></i></a>
                            </div>
                        </div>
                        @if (!empty($attributes))
                        <div class="function odering">
                            <span class="openSubOrder">Tính năng <i class="fas fa-caret-down"></i></span>
                            <div class="sub filter">
                                @foreach ($attributes as $key=> $attribute)
                                    <div class="group">
                                        <a href="javascript://" title="" class="title">{{ $key }}</a>
                                        <ul>
                                            @foreach ($attribute as $item)
                                                <li>
                                                    <label>
                                                        <span>
                                                            @if (Request::get('attr_'.$item['atb_type']) == $item['id'])
                                                                <i class='fas fa-check'></i>
                                                            @endif
                                                            <a class=" js-param-search ajax-list {{ Request::get('attr_'.$item['atb_type']) == $item['id'] ? 'active_filter' : '' }}"
                                                            data-param="attr_{{ $item['atb_type'] }}={{ $item['id'] }}"
                                                            href="{{ request()->fullUrlWithQuery(['attr_'.$item['atb_type'] => $item['id']]) }}" title="">{{ $item['atb_name'] }}</a>
                                                        </span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                                <div class="cb"></div>
                                <a href="javascript://" class="closeSub"><i class="far fa-times-circle"></i></a>
                            </div>
                        </div>
                        @endif
                        <div class="function odering">
                            <span class="openSubOrder">Sắp xếp <i class="fas fa-caret-down"></i></span>
                            <div class="sub filter">
                                <div class="group">
                                    <ul>
                                        <li>
                                            <label class="{{ Request::get('sort') == 1 ? 'active' : '' }}">
                                                <span class="check"><i class="fas fa-check"></i></span>
                                                <span><a class="js-param-search {{ Request::get('sort') == 1 ? 'active_filter' : '' }}" data-param="sort=1"
                                                    href="{{ request()->fullUrlWithQuery(['sort'=>1]) }}" title="San pham noi bat">Sản phẩm mới nhất</a></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="{{ Request::get('sort') == 2 ? 'active' : '' }}">
                                                <span class="check"><i class="fas fa-check"></i></span>
                                                <span><a class="js-param-search {{ Request::get('sort') == 2 ? 'active_filter' : '' }}" data-param="sort=2"
                                                    href="{{ request()->fullUrlWithQuery(['sort'=>2]) }}" title="Thap den cao">Giá thấp đến cao</a></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="{{ Request::get('sort') == 3 ? 'active' : '' }}">
                                                <span class="check"><i class="fas fa-check"></i></span>
                                                <span><a class="js-param-search {{ Request::get('sort') == 3 ? 'active_filter' : '' }}" data-param="sort=3"
                                                    href="{{ request()->fullUrlWithQuery(['sort'=>3]) }}" title="Cao xuong thap">Giá cao xuống thấp</a></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <a href="javascript://" class="closeSub"><i class="far fa-times-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lstChoose">
                    <ul>
                        @if (isset($typeProduct))
                            <li>
                                <a href="{{ route('get.type.product.list',$typeProduct->tp_slug.'-'.$typeProduct->id) }}" title="{{ $typeProduct->tp_name }}">
                                    {{ $typeProduct->tp_name }}
                                    <span class="icon"><i class="fas fa-times"></i></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('get.type.product.list',$typeProduct->tp_slug.'-'.$typeProduct->id) }}" title="" class="deleteAll">
                                    Xóa tất cả
                                    <span class="icon"><i class="fas fa-times"></i></span>
                                </a>
                            </li>
                        @else
                            {{-- <li><a href="javascript://" title="{{ $category_check->c_name }}">{{ $category_check->c_name }}<span class="icon"><i class="fas fa-times"></i></span></a></li> --}}
                            @if(Request::get('search')) <li><a href="{{ request()->fullUrlWithQuery(['search'=> Request::get('search')]) }}" class="js-param-search {{ Request::get('search')  ? 'active_filter' : '' }}" data-param="search={{Request::get('search')}}" title="Giá">Search ({{Request::get('search')}}) <span class="icon"><i class="fas fa-times"></i></span></a></li> @endif
                            @if(Request::get('price')) <li><a href="{{ request()->fullUrlWithQuery(['price'=> Request::get('price')]) }}" class="js-param-search {{ Request::get('price')  ? 'active_filter' : '' }}" data-param="price={{Request::get('price')}}" title="Giá">Giá<span class="icon"><i class="fas fa-times"></i></span></a></li> @endif
                            @if(Request::get('country')) <li><a href="{{ request()->fullUrlWithQuery(['country'=> Request::get('country')]) }}" class="js-param-search {{ Request::get('country')  ? 'active_filter' : '' }}" data-param="country={{Request::get('country')}}" title="Quốc Gia">Quốc Gia<span class="icon"><i class="fas fa-times"></i></span></a></li> @endif
                            @if(Request::get('sort')) <li><a href="{{ request()->fullUrlWithQuery(['sort'=> Request::get('sort')]) }}" class="js-param-search {{ Request::get('sort')  ? 'active_filter' : '' }}" data-param="sort={{Request::get('sort')}}" title="Xắp Xếp">Xắp Xếp<span class="icon"><i class="fas fa-times"></i></span></a></li> @endif
                            @if(Request::get('attr_1')) <li><a href="{{ request()->fullUrlWithQuery(['attr_1'=> Request::get('attr_1')]) }}" class="js-param-search {{ Request::get('attr_1')  ? 'active_filter' : '' }}" data-param="attr_1={{Request::get('attr_1')}}" title="Độ bền">Độ bền<span class="icon"><i class="fas fa-times"></i></span></a></li> @endif
                            @if(Request::get('attr_2')) <li><a href="{{ request()->fullUrlWithQuery(['attr_2'=> Request::get('attr_2')]) }}" class="js-param-search {{ Request::get('attr_2')  ? 'active_filter' : '' }}" data-param="attr_2={{Request::get('attr_2')}}" title="Loại Da">Loại Da<span class="icon"><i class="fas fa-times"></i></span></a></li> @endif
                            @if(Request::get('attr_3')) <li><a href="{{ request()->fullUrlWithQuery(['attr_3'=> Request::get('attr_3')]) }}" class="js-param-search {{ Request::get('attr_3')  ? 'active_filter' : '' }}" data-param="attr_3={{Request::get('attr_3')}}" title="Kích cỡ giày">Kích cỡ giày<span class="icon"><i class="fas fa-times"></i></span></a></li> @endif
                            {{-- <li><a href="{{ route('get.category.list',$category_check->c_slug.'-'.$category_check->id) }}" title="" class="deleteAll">Xóa tất cả <span class="icon"><i class="fas fa-times"></i></span></a></li> --}}
                        @endif
                    </ul>
                </div>
            </div>
            <div class="product">
                <div class="group active">
                @foreach($products as $item)
                    <div class="item">
                        <div class="wImage">
                            <a href="{{ route('get.product.detail',$item->pro_slug.'-'.$item->id) }}" title="" class="image">
                            <img data-src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->pro_name }}" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}">
                            </a>
                            @if ($item->pro_sale)<span class="top1"><span>-30%</span></span>@endif
                        </div>
                        <div class="info">
                            <p>40mm | {{ $item->pro_resistant ? $item->pro_resistant : '' }}</p>
                            <a href="{{ route('get.product.detail',$item->pro_slug.'-'.$item->id) }}" title="" class="name">
                                <h3>{{ $item->pro_name }} - {{ $item->typeproduct->tp_name }}</h3>
                            </a>
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
                            <a href="{{ route('get.shopping.add',$item->id) }}" title=""  class="btnBuy js-add-cart" rel="nofollow">Mua ngay</a>
                        </div>
                    </div>
                @endforeach
                </div>

                <nav id="phantrang">
                    {!! $products->appends($query ?? [])->links() !!}
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','.js-param-search',function(e){
                e.preventDefault();
                let $this = $(this);
                let param = $this.attr('data-param');
                let link = $this.attr('href');
                if($this.hasClass('active_filter')){
                    link = link.replace(param,'');
                }
                console.log(link);
                window.location.href = link;
            });

            $(".js-add-cart").click(function(e){
                e.preventDefault();
                let $this = $(this);
                let URL = $this.attr('href');
                console.log(URL);
                if(URL){
                    $.ajax({
                        url:URL,
                        success:function(results){
                            toastr.success(results.messages);
                            $('.js-update-qty').html(results.total_qty);
                        },
                        error:function(error){
                            console.log(error.messages);
                        }
                    });
                }
            });
        });
    </script>
@endsection
