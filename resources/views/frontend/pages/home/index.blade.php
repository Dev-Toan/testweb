@extends('layout.master_frontend')
@section('content')
    @include('frontend.components.slide',['slides'=>$slides])
<div id="cateHome">
    <div class="wrp">
        <div class="group">
        @foreach ($typeproducts as $item)
            <div class="item">
                <div class="wImage">
                    <a href="{{ route('get.type.product.list',$item->tp_slug.'-'.$item->id) }}" title="{{ $item->tp_name }}" class="image cover">
                    <img data-src="{{ pare_url_file($item->tp_banner) }}" alt="{{ $item->tp_name }}" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </a>
                </div>
                <span class="name">{{ $item->tp_name }}</span>
            </div>
        @endforeach
        </div>
    </div>
</div>
<div class="product">
    <div class="wrp">
        <a href="javascript://" title="" class="titleHead">Sản phẩm bán chạy</a>
        <div class="tabs">
            <ul class="tab-links">
                <li class="active"><a href="#tab1" title="">GIÀY CHÍNH HÃNG</a></li>
                {{-- <li><a href="#tab2" title="">GIÀY THỜI TRANG</a></li> --}}
                <li><a href="#tab3" title="">PHỤ KIỆN</a></li>
            </ul>
            <div class="tabContent">
                <div id="tab1" class="tab active">
                    <div class="group slide">
                        @foreach ($proPayDHCH as $item)
                            @include('frontend.components._inc_item_product',['item'=>$item])
                        @endforeach
                    </div>
                    <div class="btnXemthem dn">
                        <a href="javascript://" title="xem them" class="xemthem" rel="nofollow">
                        <span>Xem thêm <i class="fas fa-chevron-down"></i></span>
                        </a>
                        <a href="{{ route('get.category.list','dong-ho-chinh-hang-1') }}" title="Dong ho" class="thugon">
                        <span>Xem tất cả <i class="fas fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                
                <div id="tab3" class="tab">
                    <div class="group slide">
                        @foreach ($proPayPKDD as $item)
                            @include('frontend.components._inc_item_product',['item'=>$item])
                        @endforeach
                    </div>
                    <div class="btnXemthem dn">
                        <a href="javascript://" title="" class="xemthem" rel="nofollow">
                        <span>Xem thêm <i class="fas fa-chevron-down"></i></span>
                        </a>
                        <a href="{{ route('get.category.list','phu-kien-dong-ho-3') }}" title="Phu kien dong ho" class="thugon">
                        <span>Xem tất cả <i class="fas fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cb"></div>
<div class="divBanner">
    <div class="wrp">
        <div class="group">
            <a href="/sp/dong-ho-nu.html?&p=3&page=2" title="">
            <img data-src="{{ asset('frontend/images/wnhb15.jpg') }}" alt="Dong ho" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
            </a>
            <a href="/sp/hop-dung-dong-ho.html" title="Hop dong ho">
            <img data-src="{{ asset('frontend/images/hop-dong-ho-m.jpg') }}" alt="Day dong ho" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
            </a>
        </div>
    </div>
</div>
<div id="countCate" class="dn dbmobile-l">
    <div class="wrp">
        <div class="group">
            <a href="/phu-kien-dong-ho.html" title="Phu kien" class="item">
                <span class="ttu"><b>DÂY GIÀY</b></span>
                <span><b>178</b></span>
            </a>
            <a href="/kinh-mat-thoi-trang.html" title="Kinh mat thoi trang" class="item">
                <span class="ttu "><b>LÓT GIÀY</b></span>
                <span><b>2.020</b></span>
            </a>
            <a href="/sp/but-ky-cao-cap.html" title="Bút ký" class="item">
                <span class="ttu">MÓC KHÓA GIÀY</span>
                <span><b>11</b></span>
            </a>
            <a href="/sp/hop-dung-dong-ho.html" title="Hộp đồng hô" class="item">
                <span class="ttu"><b>HỘP GIÀY</b></span>
                <span><b>34</b></span>
            </a>
        </div>
    </div>
</div>
<div id="logoPartner">
    <div class="wrp">
    @foreach ($imageCate as $item)
        <div class="wImage">
            <a href="{{ route('get.category.list',$item->c_slug.'-'.$item->id) }}" title="{{ $item->c_name }}" class="image lazy">
            <img data-src="{{ pare_url_file($item->c_avatar) }}" alt="{{ $item->c_name }}" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}">
            </a>
        </div>
    @endforeach
    </div>
</div>
<div class="product product2">
    <div class="wrp">
        <div class="left">
            <a  class="titleCate">Flash Sale</a>
            <div class="contCate">
                Những mẫu giày đang hot năm 2024 với giá tốt. Chương trình diễn ra hàng ngày với các sản phẩm khác nhau. Nhanh tay sở hữu ngay!!!
            </div>
        </div>
        <div class="right">
            <div class="group slide2">
                @foreach ($proSaleAll as $item)
                    @include('frontend.components._inc_item_product',['item'=>$item])
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="product product3">
    <div class="wrp">
        <div class="bannerMain">
            <div class="wImage dnTablet-l">
                <a href="{{ route('get.category.list','dong-ho-chinh-hang-1') }}" title="EPos Swiss" class="image cover">
                <img data-src="{{ asset('frontend/images/EP246.jpg') }}" alt="" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                </a>
            </div>
            <div class="wImage dn dbtablet-l">
                <a href="{{ route('get.category.list','dong-ho-chinh-hang-1') }}" title="Epos" class="image cover">
                <img data-src="{{ asset('frontend/images/EP246M.jpg') }}" alt="" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                </a>
            </div>
            <h2 class="info">
                <a href="{{ route('get.category.list','dong-ho-chinh-hang-1') }}" title="Epos Swiss" class="name">
                <span>SẢN PHẨM HÓT NHẤT</span>                    <span class="dn dbtablet-l"> </span>
                <span>2020</span>
                </a>
                <a href="{{ route('get.category.list','dong-ho-chinh-hang-1') }}" title="Epos Swiss" class="viewAll">Xem tất cả <i class="fas fa-chevron-right"></i></a>
            </h2>
        </div>
        <div class="group slide3">
            @foreach ($proHot as $item)
                @include('frontend.components._inc_item_product',['item'=>$item])
            @endforeach
        </div>
        <a href="{{ route('get.category.list','dong-ho-chinh-hang-1') }}" title="Epos Swiss" class="dn dbtablet-l viewAllText">XEM TẤT CẢ</span> <i class="fas fa-caret-right"></i></a>
    </div>
</div>

<div class="product product2">
    <div class="wrp">
        <div class="left">
            <a  title="Khuyến mại" class="titleCate">Sản phẩm mới</a>
            {{-- <div class="contCate">
                Những mẫu giày đang hot năm 2024 với giá tốt. Chương trình diễn ra hàng ngày với các sản phẩm khác nhau. Nhanh tay sở hữu ngay!!!
            </div> --}}
        </div>
        <div class="right">
            <div class="group slide2">
                @foreach ($productNews as $item)
                    @include('frontend.components._inc_item_product',['item'=>$item])
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="cb"></div>
@foreach ($proCate3 as $catepro)
    <div class="product">
        <div class="wrp">
            <h2 class="titleCate">
                <a href="{{ route('get.category.list',$catepro->c_slug.'-'.$catepro->id) }}" title="Philippe August">
                <span class="icon"><img data-src="{{ asset('frontend/images/icon1.png') }}" alt="Philippe August" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/></span>
                {{ $catepro->c_name }}
                </a>
            </h2>
            <div class="group slide">
                @foreach ($catepro->products as $item)
                    @include('frontend.components._inc_item_product',['item'=>$item])
                @endforeach
            </div>
            <div class="btnXemthem dn">
                <a href="javascript://" title="xem them" class="xemthem" rel="nofollow">
                <span>Xem thêm <i class="fas fa-chevron-down"></i></span>
                </a>
                <a href="{{ route('get.category.list',$catepro->c_slug.'-'.$catepro->id) }}" title="Dong ho" class="thugon">
                <span>Xem tất cả <i class="fas fa-angle-right"></i></span>
                </a>
            </div>
        </div>
    </div>
    <div class="stv_barrie"></div>
@endforeach

@endsection
