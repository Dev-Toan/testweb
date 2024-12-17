<div id="commonHead">
    <div class="wrp">
        <a href="/" title="" class="logoRes dn dbtablet-l">
            <img src="{{ asset('frontend/images/logotatduc.png') }}" alt="Logo">
        </a>
        <h1 class="textLeft dnTablet-l">Giày Biti's</h1>
        <form class="frmSearch" action="{{route('get.search')}}" method="get">
            <div class="flex">
                <input type="text" name="search" id="keyword" value="{{Request::get('search')}}" placeholder="Nhập từ khóa tìm kiếm..." />
                <button class="btnSearch">
                <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <ul class="menuRight dnTablet-l">
            <li><a href="/" title="Home">Trang chủ</a></li>
            <li><a href="{{ route('get.article.index') }}" title="Tin tức">Tin tức giày</a></li>
            @if (Auth::check())
                <li><a href="{{ route('get.user.dashboard') }}" title="Xem Profile">Xem Profile ({{Auth::user()->name}})</a></li>
                <li><a href="{{ route('get.logout') }}" title="Đăng Xuất">Đăng Xuất</a></li>
            @else
                <li><a href="{{ route('get.register') }}" title="Đăng Ký">Đăng Ký</a></li>
                <li><a href="{{ route('get.login') }}" title="Đăng Nhập">Đăng Nhập</a></li>
            @endif
        </ul>
        <a href="javascript://" class="openList">
            <div>
                <hr/>
                <hr/>
                <hr/>
            </div>
            <span>Close</span>
        </a>
        <div id="menuRes" class="dn">
            <ul class="menuCate">
            @foreach ($categories as $item)
                <li><a href="{{ route('get.category.list',$item->c_slug.'-'.$item->id) }}" title="{{ $item->c_name }}">{{ $item->c_name }}</a></li>
            @endforeach
            </ul>
            <div class="hotline">
                <span>Gọi mua hàng: </span>
                <a href="tel:18006005" title="1800.6005"><span class="icon"><i class="fas fa-phone"></i></span> 1800.6005</a>
                <span>(8:30 - 21:30)</span>
            </div>
            <div class="countCate">
            @foreach ($product_typess as $item)
                <a href="{{ route('get.type.product.list',$item->tp_slug.'-'.$item->id) }}" title="Đồng hồ nam" class="item">
                    <span>{{ $item->tp_name }}</span>
                    <span><b>{{ $item->product->count() }}</b></span>
                    <span>Sản phẩm</span>
                </a>
            @endforeach
            </div>
            <ul class="lstProduct">
            @foreach ($cateImages as $item)
                <li><a href="{{ route('get.category.list',$item->c_slug.'-'.$item->id) }}" title="{{ $item->c_name }}">{{ $item->c_name }}</a></li>
            @endforeach
                <li><a href="{{ route('get.article.index') }}" title="Tin tức">Tin tức - sự kiện</a></li>
                <li><a href="javascript://" title="Cửa hàng">Hệ thống cửa hàng (1 Showroom)</a></li>
                @if (Auth::check())
                    <li><a href="{{ route('get.user.dashboard') }}" title="Xem Profile">Xem Profile</a></li>
                    <li><a href="{{ route('get.logout') }}" title="Đăng Xuất">Đăng Xuất</a></li>
                @else
                    <li><a href="{{ route('get.register') }}" title="Đăng Ký">Đăng Ký</a></li>
                    <li><a href="{{ route('get.login') }}" title="Đăng Nhập">Đăng Nhập</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div id="header">
    <div class="wrp">
        <a href="/" title="Home" class="logo">
        <img width = "250 px" hight = "250 px" src="{{ asset('frontend/images/logotatduc.png') }}" alt="Logo"/>
        </a>
        <div id="menuMain">
            <ul>
            @foreach ($categories as $categorys)
                <li class="hasChild">
                    <a href="{{ route('get.category.list',$categorys->c_slug.'-'.$categorys->id) }}" class="active" title="{{ $categorys->c_name }}" >{{ $categorys->c_name }}</a>
                    <ul>
                        <li>
                            <div class="subMenu" style="width: 250px;">
                                <div class="group">
                                    <div class="item">
                                    @foreach ($categorys->children as $item)
                                        <a href="{{ route('get.category.list',$item->c_slug.'-'.$item->id) }}" title="{{ $item->c_name }}">{{ $item->c_name }}</a>
                                    @endforeach
                                    </div>
                                </div>
                                {{--  <div class="group">
                                    <div class="item">
                                        <a href="/sp/dong-ho-QQ.html" title="Q&Q">Giày Q&Q</a>
                                        <a href="/sp/bruno-sohnle-glashutte.html" title="Bruno Sohnle Glashutte">Bruno Sohnle Glashutte</a>
                                        <a href="/sp/dong-ho-citizen.html" title="Citizen">Giày Citizen</a>
                                        <a href="/sp/stuhrling-original-swiss.html" title="Stuhrling Original">Stuhrling Original Swiss</a>
                                    </div>
                                </div>  --}}
                            </div>
                        </li>
                    </ul>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="right">
            <a href="tel:0343754517" title="Hotline" class="item">
                <span class="icon">
                    <img data-src="{{ asset('frontend/images/hotline.png') }}" alt="Hotline" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                </span>
                <span class="text">
                    <span class="top">Hotline</span>
                    <span class="bot">034.375.4517</span>
                </span>
            </a>
            <a href="/he-thong-cua-hang/" title="Showroom" class="item">
                <span class="icon">
                    <img data-src="{{ asset('frontend/images/address.png') }}" alt="Cua hang" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                </span>
                <span class="text">
                    <span class="top">Hệ thống</span>
                    <span class="bot">Cửa hàng</span>
                </span>
            </a>
            <a href="{{ route('get.shopping.list') }}" title="Cart" class="btnCart">
                <i class="fas fa-shopping-cart"></i>
                <span class="number js-update-qty">{{ Cart::count() }}</span>
            </a>
        </div>
    </div>
</div>
