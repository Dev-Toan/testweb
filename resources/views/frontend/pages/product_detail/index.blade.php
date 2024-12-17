@extends('layout.master_frontend')
@section('css')
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/product_detail.css') }}">
@endsection
@section('content')

<div id="pageway">
    <div class="wrp">
        <ul>
            <li><a href="{{ route('get.category.list',$product->category->parent->c_slug.'-'.$product->category->parent->id) }}" title="{{ $product->category->parent->c_name }}"><b>{{ $product->category->parent->c_name }}</b></a></li>
            <li><a href="{{ route('get.category.list',$product->category->c_slug.'-'.$product->category->id) }}" title="{{ $product->category->c_name }}" style="color: #288ad6">{{ $product->category->c_name }}</a></li>
            <li><a href="{{ route('get.type.product.list',$product->typeproduct->tp_slug.'-'.$product->typeproduct->id) }}" title="{{ $product->typeproduct->tp_name }}" style="color: #288ad6">{{ $product->typeproduct->tp_name }}</a></li>
            <li><a href="javacript://" title="" rel="nofollow">Có <span class="fRobotoB" style="color:#ff5722">{{ $product->typeproduct->product->count() }}</span> Sản Phẩm</a></li>
        </ul>
    </div>
</div>
<div class="cb"></div>

<div id="container">
    <div id="menuCate" class="dnTablet-l">
        <div class="wrp">
            <div class="group">
            @foreach ($imagesType as $item)
                <a href="{{ route('get.type.product.list',$item->tp_slug.'-'.$item->id) }}" title="{{ $item->tp_name }}" class="item">
                    <div class="img">
                        <div class="wImage cover">
                            <span class="image">
                            <img src="{{ pare_url_file($item->tp_avatar) }}" style="display: block;" >
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
            @foreach ($imagesType as $item)
                <a href="{{ route('get.type.product.list',$item->tp_slug.'-'.$item->id) }}" title="{{ $item->tp_name }}" class="item">
                    <span class="ttu fRobotoB">{{ $item->tp_name }}</span>
                    <span>Có <b>{{ $item->product->count() }}</b></span>
                </a>
            @endforeach
            </div>
        </div>
    </div>
    <div id="product">
        <div class="wrp">
            <div class="nameCate lsh">
                <a href="{{ route('get.category.list',$product->category->c_slug.'-'.$product->category->id) }}" title="{{ $product->category->c_name }}" class="name">{{ $product->category->c_name }}  - {{ $product->typeproduct->tp_name }}</a>
                {{--  <div class="share">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-href="" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                </div>  --}}
            </div>
            <div class="detailPro">
                <div class="top">
                    <div class="left">
                        <div class="imgSmall">
                            <div class="img">
                                <div class="wImage">
                                    <a href="javascript://" title="" class="image">
                                    <img data-lazy="{{ pare_url_file($product->pro_avatar) }}" alt="" />
                                    </a>
                                </div>
                            </div>

                            @foreach ($product->images as $item)
                                <div class="img">
                                    <div class="wImage">
                                        <a href="javascript://" title="" class="image">
                                        <img data-lazy="{{ pare_url_file($item->img_slug) }}" alt="" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="imgLarge">
                            <div class="img">
                                <div class="wImage">
                                    <a href="javascript://" title="" class="image">
                                    <img data-lazy="{{ pare_url_file($product->pro_avatar) }}" alt="" />
                                    </a>
                                </div>
                            </div>
                            @foreach ($product->images as $item)
                                <div class="img">
                                    <div class="wImage">
                                        <a href="javascript://" title="" class="image">
                                        <img data-lazy="{{ pare_url_file($item->img_slug) }}" alt="" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="right">
                        <h1><a href="javascript://" title="" class="namePro">{{ $product->pro_name }}</a></h1>
                        <div class="price">
                            <div class="price1">
                                <span class="text">Giá niêm yết</span>
                                @if($product->pro_sale)
                                    <span class="numb old">{{ number_format($product->pro_price,0,',','.') }}đ</span>
                                    @php
                                        $priceSale = ($product->pro_price)/100 *(100-$product->pro_sale)
                                    @endphp
                                    <span class="numb new dn dbtablet-l">{{ number_format($priceSale,0,',','.') }}đ</span>
                                @else
                                    <span class="numb cc4161c">{{ number_format($product->pro_price,0,',','.') }}đ</span>
                                @endif
                            </div>
                            @if ($product->pro_sale)
                                <div class="sale">
                                    <span class="text">Sale</span>
                                    <span class="numb">{{ $product->pro_sale }}%</span>
                                </div>
                                <div class="price1 dnTablet-l">
                                    <span class="text">Giá khuyến mại</span>
                                    <span class="numb cc4161c">{{ number_format($priceSale,0,',','.') }}đ</span>
                                </div>
                            @else
                                <div style="color: #3498db;">
                                    <span><i>Miễn phí vận chuyển!</i></span>
                                </div>
                            @endif
                        </div>
                        <h3 class="descript">
                            <div class="item">
                                <span class="text">Lượt Mua</span>
                                <span class="num">{{ $product->pro_pay }}</span>
                            </div>
                            @if ($product->pro_resistant)
                                <div class="item">
                                    <span class="text">Độ chịu lực</span>
                                    <span class="num">{{ $product->pro_resistant }}</span>
                                </div>
                                {{-- <div class="item">
                                    <span class="text">Chất liệu da</span>
                                    <span class="num">Kính sapphire </span>
                                </div> --}}
                                <div class="item">
                                    <span class="text">Độ bền sử dụng</span>
                                    <span class="num">{{ $product->pro_energy }}</span>
                                </div>
                            @else
                                <div class="item">
                                    <span class="text">Lượt View</span>
                                    <span class="num">{{ $product->pro_view }}</span>
                                </div>
                            @endif
                        </h3>
                        <div class="khuyenmai">
                            <div class="title">Khuyến mãi</div>
                            <div class="group">
                                <div class="item">
                                    <div class="wImage">
                                        <a href="#" title="" class="image cover">
                                        <img data-src="{{ asset('frontend/images/KMKM1.jpg') }}" alt="" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                                        </a>
                                    </div>
                                    <a href="javascript://" title="Kinh mat" class="info">
                                        <p style="color: #007bff; font-family: RobotoB">Tặng ngay giày Diamond D hoặc Philippe Auguste</p>
                                        <p>Khi mua giày trị giá trên 5 triệu cùng 01 hóa đơn.</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="hotline">
                            <span>Gọi đặt mua: </span>
                                <a href="tel:035.522.3344" title="035.522.3344"><span class="icon"><i class="fas fa-phone"></i></span> 035.522.3344</a>
                            <span>(8:30 - 21:30)</span>
                        </div>
                        <div class="btnCart">
                            @if ($product->pro_number - $product->pro_pay > 0)
                                <a href="{{ route('get.shopping.add',$product->id) }}" title="Add to cart"  class="muangay js-add-cart">
                                    <span>Mua ngay</span>
                                    <span>Giao hàng miễn phí - Thanh toán tại nhà</span>
                                </a>
                            @else
                            <a href="{{ route('get.shopping.add',$product->id) }}" title="Add to cart"  class="muangay js-add-cart">
                                <span>Đã hết hàng</span>
                                <span>liên hệ Admin</span>
                            </a>
                            @endif
                            <a href="{{ route('ajax_get.user.add',$product->id) }}" title=""  class="muatragop {{ !Auth::id() ? 'js-show-login' : 'js-add-favourite' }}">
                                <span>Yêu Thích</span>
                                <span>Thêm Sản Phẩm Vào BST Yêu Thích</span>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="bot">
                    <div class="detail">
                        <div class="otherPro slideRes">
                            <h3 class="title">Có thể bạn sẽ thích</h3>
                            <div class="group">
                            @foreach ($productSuggests as $item)
                                <div class="item">
                                    <div class="wImage">
                                        <a href="{{ route('get.product.detail',$item->pro_slug.'-'.$item->id) }}" title="" class="image">
                                        <img data-src="{{ pare_url_file($item->pro_avatar) }}" alt="{{ $item->pro_name }}" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                                        </a>
                                    </div>
                                    <h3 class="info">
                                        <a href="{{ route('get.product.detail',$item->pro_slug.'-'.$item->id) }}" title="" class="name">
                                        {{ $item->pro_name }} - {{ $item->typeproduct->tp_name }}                </a>
                                        <div class="price">
                                            <p class="new">{{ number_format($item->pro_price,0,',','.') }} đ</p>
                                        </div>
                                    </h3>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="dn dbTablet">
                            <div class="thongsokythuat">
                                <div class="titleR">Thông số</div>
                                <div class="group">
                                    <div class="item">
                                        <p class="text1">Quốc Gia</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->getCountry($product->pro_country) }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Kiểu dáng</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->typeproduct->tp_name }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Chống lực</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->pro_resistant }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Độ bền sử dụng</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->pro_energy }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Lượt View</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->pro_view }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Số lượng</p>
                                        <p class="text2"><a href="javascript://" title="">{{ ($product->pro_number) }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Chế độ bảo hành</p>
                                        <p class="text2">Bảo hành quốc tế <b><a href="javascript://" title="">{{ ($product->pro_pay) }}</a></b> năm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tuvanbanhang">
                                <div class="titleR">Tư vấn bán hàng</div>
                                <div class="group">
                                    @for($i=1;$i<=6;$i++)
                                        <a href="tel:0355223344" title="035.522.3344" class="item">
                                            <img data-src="{{ asset('frontend/images/sale_phone.png') }}" alt="" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                                            <span class="text">
                                                035.522.3344
                                            </span>
                                        </a>
                                    @endfor
                                </div>
                            </div>
                            <div class="box_policy">
                                <div class="fs14">
                                    <img class="mr-1" src="{{ asset('frontend/images/box.png') }}" alt="" height="17">
                                    Sản phẩm Fullbox:
                                </div>
                                <div style="display: flex;padding-top: 5px;font-style: italic;">
                                    <a class="name" href="javascript://" title="Fullbox">       <span>
                                    Hộp đựng, thẻ bảo hành quốc tế, thẻ khách hàng thân thiết, khăn lau </span>
                                    </a>
                                </div>
                                <div class="pt10 fsfs1416">
                                    <img class="mr-1" src="{{ asset('frontend/images/doi.png') }}" alt="" height="17">
                                    <a class="name" href="javascript://" title="Đổi sản phẩm">
                                    30 ngày đổi sản phẩm miễn phí.
                                    </a>
                                </div>
                                <div class="pt10 fs14">
                                    <img class="mr-1" src="{{ asset('frontend/images/ship.png') }}" alt="" height="17">
                                    <a class="name" href="javascript://" title="Ship">
                                    Giao miễn phí, nhận hàng kiểm tra trước khi thanh toán
                                    </a>
                                </div>
                                <div class="pt10 fs14">
                                    <img class="mr-1" src="{{ asset('frontend/images/vat.png') }}" alt="" height="17">
                                    <a class="name" href="javascript://" title="Hóa đơn">
                                    Chính hãng 100% - xuất hoá đơn VAT
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mainDes">
                            <div class="tabs">
                                <ul class="tab-links">
                                    <li class="active"><a href="#ctsp" title="">Chi tiết</a></li>
                                    <li><a href="#hdsd" title="">Chế độ bảo hành</a></li>
                                    <li><a href="#cdbh" title="">Hướng dẫn sử dụng</a></li>
                                </ul>
                                <div class="tabContent">
                                    <div id="ctsp" class="tab active">
                                        <div class="content">
                                            <h3><span style="font-size:14px"><strong>{{ $product->pro_name }} </strong></span></h3> <br>
                                            <h3><span style="font-size:14px">{{ $product->pro_description }}</span></h3>
                                            <p style="text-align:center"><span style="font-size:14px"><span style="font-family:helvetica,arial,dejavu sans,liberation sans,freesans,sans-serif">
                                                <img alt="" data-src="{{ pare_url_file($product->pro_avatar) }}"  class="lazy" src="{{ asset('frontend/images/loading1.gif') }}"/></span></span></p>
                                            <p><span style="font-size:14px">{{$product->pro_content}}</span>
                                            </p>
                                        </div>
                                        <p class="show-more" style="display:block;position:sticky;" onclick="$(this).prev('.content').addClass('active'); $(this).remove()">
                                            <a id="xem-them-bai-viet" href="javascript:;" class="readmore">Đọc thêm</a>
                                        </p>
                                    </div>
                                    <div id="hdsd" class="tab">
                                        <div class="content">
                                            <h2><strong>1. Địa chỉ Trung t&acirc;m bảo h&agrave;nh của <a href="javascript://">Nhóm 5 Biti's</a>:</strong></h2>
                                                <ol style="list-style-type:lower-roman">
                                                    <li><span style="font-size:14px">H&agrave; Nội: Số 298 đường Cầu Diễn, quận Bắc Từ Liêm, H&agrave; Nội | Tel:&nbsp;</span>035.522.3344</li>
                                                    <li><span style="font-size:14px">Đ&agrave; Nẵng: Số 40 Ho&agrave;ng Hoa Th&aacute;m, Thanh Kh&ecirc;, TP. Đ&agrave; Nẵng |&nbsp;</span>035.522.3344</li>
                                                    <li><span style="font-size:14px">Hồ Ch&iacute; Minh: </span>Số 88 Trần Quang Khải, P T&acirc;n Định, Quận 1, TP. HCM&nbsp;<span style="font-size:14px">| Tel:&nbsp;</span>035.522.3344</li>
                                                </ol>
                                            <h2><strong>2.&nbsp;Thời gian nhận v&agrave; trả bảo h&agrave;nh:</strong></h2>
                                            <p>v&nbsp; Tại trung t&acirc;m bảo h&agrave;nh: Từ 8h30 đến 17h00 c&aacute;c ng&agrave;y trong tuần (trừ chủ nhật v&agrave; c&aacute;c ng&agrave;y lễ, Tết).</p>
                                            <p>v&nbsp; Tại c&aacute;c hệ thống 100 cửa h&agrave;ng Nhóm 5 Biti's tr&ecirc;n to&agrave;n quốc tất cả c&aacute;c ng&agrave;y trong tuần kể cả ng&agrave;y lễ v&agrave; chủ nhật, từ 8h30 đến 21h</p>
                                            <h2><strong>3. Ch&iacute;nh s&aacute;ch bảo h&agrave;nh:</strong></h2>
                                            <ol style="list-style-type:lower-roman">
                                                <li><span style="font-size:14px">Giày được bảo h&agrave;nh từ 1-2 năm kể từ ng&agrave;y mua theo quy định của h&atilde;ng sản xuất (t&ugrave;y từng h&atilde;ng sẽ c&oacute; thời gian bảo h&agrave;nh kh&aacute;c nhau).</span></li>
                                                <li><span style="font-size:14px">Ri&ecirc;ng kh&aacute;ch h&agrave;ng mua giày tại hệ thống Nhóm 5 Biti's sẽ được hưởng th&ecirc;m những quyền lợi sau:</span></li>
                                                <li><span style="font-size:14px">Thay dây giày miễn ph&iacute; trọn đời sản phẩm &aacute;p dụng&nbsp;đối với 1 số thương hiệu giày khi mua tại Nhóm 5 Biti's</span></li>
                                            </ol>
                                            <h2><strong>4. Phạm</strong>&nbsp;<strong>vi tiếp nhận giày bảo h&agrave;nh v&agrave; sửa chữa:</strong></h2>
                                            <ol style="list-style-type:lower-roman">
                                                <li><span style="font-size:14px">Nhóm 5 Biti's tiếp nhận bảo h&agrave;nh v&agrave; sửa chữa đối với tất cả c&aacute;c sản phẩm được mua tại hệ thống </span>Nhóm 5 Biti's&nbsp;<span style="font-size:14px">Giày.</span></li>
                                                <li><span style="font-size:14px">Những sản phẩm mang thương hiệu m&agrave; </span>Nhóm 5 Biti's&nbsp;<span style="font-size:14px">Giày l&agrave; nh&agrave; ph&acirc;n phối độc quyền tại Việt Nam cũng sẽ tiếp nhận bảo h&agrave;nh v&agrave; sửa chữa.</span></li>
                                                <li><span style="font-size:14px">Ngo&agrave;i những trường hợp n&ecirc;u tr&ecirc;n, </span>Nhóm 5 Biti's&nbsp;<span style="font-size:14px">Giày sẽ tiếp nhận để bảo h&agrave;nh hoặc sửa chữa cho qu&yacute; kh&aacute;ch h&agrave;ng.</span></li>
                                            </ol>
                                            <h2><strong>5. Điều kiện để giày được bảo h&agrave;nh miễn ph&iacute; v&agrave; c&aacute;ch t&iacute;nh ph&iacute; đối với giày sửa chữa:</strong></h2>
                                            <ol style="list-style-type:lower-roman">
                                                <li><span style="font-size:14px">Nếu giày mua tại </span>Nhóm 5 Biti's&nbsp;<span style="font-size:14px">Giày v&agrave; c&ograve;n trong thời gian bảo h&agrave;nh, kh&aacute;ch h&agrave;ng phải xuất tr&igrave;nh được những giấy tờ li&ecirc;n quan đến sản phẩm như sổ bảo h&agrave;nh hoặc h&oacute;a đơn mua h&agrave;ng&hellip;, kh&aacute;ch h&agrave;ng sẽ được bảo h&agrave;nh miễn ph&iacute; theo như quy định của h&atilde;ng sản xuất.</span></li>
                                                <li><span style="font-size:14px">Nếu giày hết thời gian bảo h&agrave;nh hoặc Kh&aacute;ch h&agrave;ng kh&ocirc;ng mang theo giấy tờ cần thiết li&ecirc;n quan đến sản phẩm th&igrave; Kh&aacute;ch h&agrave;ng sẽ mất ph&iacute; sửa chữa.</span></li>
                                            </ol>
                                        </div>
                                        <p class="show-more" style="display:block;position:sticky;" onclick="$(this).prev('.content').addClass('active'); $(this).remove()">
                                            <a id="xem-them-bai-viet" href="javascript:;" class="readmore">Đọc thêm</a>
                                        </p>
                                    </div>
                                    <div id="cdbh" class="tab">
                                        <div class="content">

                                        </div>
                                        <p class="show-more" style="display: block; position: sticky;" onclick="$(this).prev('.content').addClass('active');$(this).remove()">
                                            <a id="xem-them-bai-viet" href="javascript:;" class="readmore">Đọc thêm</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="splienquan">
                            <div class="item">
                                <div class="left">
                                    <div class="wImage">
                                        <a href="javascript://" title="" class="image">
                                        <img data-src="{{ pare_url_file($product->pro_avatar) }}" alt="" class="lazy" src="{{ asset('frontend/images/loading1.gif') }}"/>
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="javascript://" title="" class="name">
                                        {{ $product->pro_name }}
                                        </a>
                                        <p class="price">{{ number_format($product->pro_price,0,',','.') }}đ  </p>
                                    </div>
                                </div>
                                <div class="lstBtn">
                                    <a href="{{ route('get.shopping.add',$product->id) }}"   title="" class="buttn muangay js-add-cart">Mua ngay</a>
                                    {{-- <a href="javascript://"   title="" class="buttn">Mua trả góp 0%</a> --}}
                                </div>
                            </div>
                        </div>
                        <div>
                            @include('frontend.pages.product_detail.include._inc_ratings')
                        </div>
                    </div>
                    <div class="detailRight">
                        <div class="dntablet">
                            <div class="thongsokythuat">
                                <div class="titleR">Thông số</div>
                                @if ($product->category->c_parent_id == config('contants.ID_CATEGORY_DEFAULT.DHCH'))
                                    <div class="group">
                                        <div class="item">
                                            <p class="text1">Quốc Gia</p>
                                            <p class="text2"><a href="javascript://" title="">{{ $product->getCountry($product->pro_country) }}</a></p>
                                        </div>
                                        <div class="item">
                                            <p class="text1">Kiểu dáng</p>
                                            <p class="text2"><a href="javascript://" title="">{{ $product->typeproduct->tp_name }}</a></p>
                                        </div>
                                        <div class="item">
                                            <p class="text1">Chống lực</p>
                                            <p class="text2"><a href="javascript://" title="">{{ $product->pro_resistant }}</a></p>
                                        </div>
                                        <div class="item">
                                            <p class="text1">Độ bền sử dụng</p>
                                            <p class="text2"><a href="javascript://" title="">{{ $product->pro_energy }}</a></p>
                                        </div>
                                        <div class="item">
                                            <p class="text1">Lượt View</p>
                                            <p class="text2"><a href="javascript://" title="">{{ $product->pro_view }}</a></p>
                                        </div>
                                        <div class="item">
                                            <p class="text1">Số lượng</p>
                                            <p class="text2"><a href="javascript://" title="">{{ ($product->pro_number) }}</a></p>
                                        </div>
                                        <div class="item">
                                            <p class="text1">Chế độ bảo hành</p>
                                            <p class="text2">Bảo hành quốc tế <b><a href="javascript://" title="">{{ ($product->pro_pay) }}</a></b> năm</p>
                                        </div>
                                    </div>
                                @else
                                <div class="group">
                                    <div class="item">
                                        <p class="text1">Quốc Gia</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->getCountry($product->pro_country) }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Kiểu dáng</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->typeproduct->tp_name }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Chống lực</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->pro_resistant }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Độ bền sử dụng</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->pro_energy }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Lượt View</p>
                                        <p class="text2"><a href="javascript://" title="">{{ $product->pro_view }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Số lượng</p>
                                        <p class="text2"><a href="javascript://" title="">{{ ($product->pro_number) }}</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Chế độ bảo hành</p>
                                        <p class="text2">Bảo hành quốc tế <b><a href="javascript://" title="">{{ ($product->pro_pay) }}</a></b> năm</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="tuvanbanhang">
                                <div class="titleR">Tư vấn bán hàng</div>
                                <div class="group">
                                @for($i=1;$i<=6;$i++)
                                    <a href="tel:0367530598" title="036.753.0598" class="item">
                                        <img data-src="{{ asset('frontend/images/sale_phone.png') }}" alt="" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                                        <span class="text">
                                            035.522.3344
                                        </span>
                                    </a>
                                @endfor
                                </div>
                            </div>
                        </div>
                        <div class="tintucsanpham">
                            <div class="titleR">TIN TỨC - SỰ KIỆN</div>
                            <div class="group">
                                @if (isset($articles))
                                    @foreach ($articles as $item)
                                    <div class="item">
                                        <div class="wImage">
                                            <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" class="image cover">
                                            <img data-src="{{ pare_url_file($item->a_avatar) }}" alt="{{ $item->a_name }}" class="lazy" src="{{ asset('frontend/images/loading1.gif') }}"/>
                                            </a>
                                        </div>
                                        <a href="{{ route('get.article.detail.index',$item->a_slug.'-'.$item->id) }}" class="name">
                                        {{ $item->a_name }}
                                        </a>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <link href="{{ asset('frontend/css/lightbox.css') }}" rel='stylesheet' type='text/css' />
    <script src="{{ asset('frontend/js/jquery.elevatezoom308.min.js') }}" type='text/javascript'></script>
    <script src="{{ asset('frontend/js/jquery.prettyphoto.min005e.js') }}" type='text/javascript'></script>
    <script src="{{ asset('frontend/js/jquery.prettyphoto.init.min367a.js') }}" type='text/javascript'></script>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            // add vào yêu thích
            $(".js-add-favourite").click(function(event){
                event.preventDefault();
                let $this=$(this);
                let URL=$this.attr('href');

                if(URL){
                    $.ajax({
                        url:URL,
                        method:"POST",
                        data:{
                            _token: '{{csrf_token()}}',
                        },
                        success:function(results){
                            if(results.code == 200) {
                                toastr.success(results.messages);
                            } else {
                                toastr.warning(results.messages);
                                // console.log(results.error);
                            }
                        },
                        error:function(error){
                            console.log(error.messages);
                        }
                    });
                }
            });

            // thêm giỏ hàng bằng ajax
            $(".js-add-cart").click(function(e){
                e.preventDefault();
                let $this = $(this);
                let URL = $this.attr('href');

                if(URL){
                    $.ajax({
                        url:URL,
                        success:function(results){
                            if(results.code == 200) {
                                toastr.success(results.messages);
                            } else {
                                toastr.warning(results.messages);
                            }
                            $('.js-update-qty').html(results.total_qty);
                        },
                        error:function(error){
                            console.log(error.messages);
                        }
                    });
                }
            });

            // check login
            $('.js-show-login').click(function(event){
                event.preventDefault();
                toastr.warning("Bạn Phải Đăng Nhập Đẻ Thực Hiện Chức Năng Này !");
            });

            $('.js-show-rating').click(function(e){
                e.preventDefault();
                $('#form-review').toggle(1000);
            });

            // hover icon thay doi so sao danh gia
            let $item = $('#ratings i');
            let arrTextRating = {
                1 : " Không Thích",
                2 : " Tạm Được",
                3 : " Bình Thường",
                4 : " Rất Tốt",
                5 : " Tuyệt Vời"
            };
            $item.mouseover(function (){
                let $this = $(this);
                let $i    = $this.attr('data-i');
                $('#review_value').val($i);
                $item.removeClass('star-null-active star-active');
                $item.each(function(key, value){
                    if(key + 1 <=$i){
                        $(this).addClass('star-active');
                    }
                });
                $('#reviews-text').removeClass('hide');
                $('#reviews-text').text(arrTextRating[$i]);
            });


            // gui danh gia di
            $(document).on('click','.js-process-review',function(e){
                e.preventDefault();
                let URL  = $(this).parents('form').attr('action');
                $.ajax({
                    url:URL,
                    type:"POST",
                    data:$('#form-review').serialize(),
                    success:function(results){
                        $('#form-review')[0].reset();
                        console.log(results.html);
                        if(results.html){
                            if($('.ratingLst .par').length > 4) {
                                $('.ratingLst .par').last().remove();
                            }
                            $('.ratingLst').prepend(results.html);
                            $('#form-review').hide(1000);
                        }
                        toastr.success(results.messages);
                    }
                });
                $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
               });
            });
            console.log();
        });
    </script>
@endsection
