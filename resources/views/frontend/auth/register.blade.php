@extends('layout.master_frontend')
@section('content')
<div id="pageway" style="border-bottom: 5px solid #e5e5e5;">
    <div class="wrp">
        <ul>
            <li><a href="/" title="Home"><b>TRANG CHỦ</b></a></li>
            <li><a href="javascript://" title="Đăng Ký" style="color: #288ad6"><b>Đăng Ký</b></a></li>
        </ul>
    </div>
</div>
<link href="{{ asset('frontend/css/cart.css') }}" rel="stylesheet" />

<div id="container">
    <div class="wrp">
        <div id="product" class="cart">
            <div class="flex">
                <div class="infoDatHang flex_1">
                    <div class="group">
                        <div class="c000 fSFUHelveticaCondensedBold ttu fs20 pb20" style="text-align: center;color: #288ad6;">ĐĂNG KÝ ĐỂ LÀM THÀNH VIÊN NÀO</div>
                        <p class="fsti pb10 tac">Lưu ý: Các ô có dấu <span class="cRed">(*)</span> cần điền đầy đủ thông tin</p>
                        <div class="form" style="width: 60%;margin: auto;">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="cRed">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="from_cart_register" method="post">
                                @csrf
                                <div class="item">
                                    <p class="label">Họ Và Tên <span class="cRed">(*)</span></p>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập Họ Và Tên" required />
                                    {{-- @if ($errors->first('name'))
                                        <span class="text-danger cRed">{{ $errors->first('name') }}</span>
                                    @endif --}}
                                </div>
                                <div class="item">
                                    <p class="label">Phone <span class="cRed">(*)</span></p>
                                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Nhập Số Điện Thoại" required />
                                    {{-- @if ($errors->first('phone'))
                                        <span class="text-danger cRed" style="font-size: 10px">{{ $errors->first('phone') }}</span>
                                    @endif --}}
                                </div>
                                <div class="item">
                                    <p class="label">Email <span class="cRed">(*)</span></p>
                                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Nhập email" required />
                                    {{-- @if ($errors->first('email'))
                                        <span class="text-danger cRed" style="font-size: 10px">{{ $errors->first('email') }}</span>
                                    @endif --}}
                                </div>
                                <div class="item">
                                    <p class="label">Mật Khẩu <span class="cRed">(*)</span></p>
                                    <input type="password" name="password" value=""   placeholder="Nhập mật khẩu" required  />
                                    {{-- @if ($errors->first('password'))
                                        <span class="text-danger cRed">{{ $errors->first('password') }}</span>
                                    @endif --}}
                                </div>
                                <div class="item">
                                    <p class="label">Địa chỉ <span class="cRed">(*)</span></p>
                                    <input type="address" name="address" value=""   placeholder="nhập địa chỉ" required  />
                                    {{-- @if ($errors->first('address'))
                                        <span class="text-danger cRed">{{ $errors->first('address') }}</span>
                                    @endif --}}
                                </div>
                                <div class="cb h10"></div>
                                <div class="btnThanhToan">
                                    <button class="tac"  type="submit" style="margin: auto;">
                                        <p class="ttu fHelveticaNeueB fs15">Đăng Ký</p>
                                        <p>(click vào đây để Đăng Ký làm thành viên)</p>
                                    </button>
                                </div>
                                <div class="btnThanhToan">
                                    <button onclick="window.location.href='auth/google/url'" style="background: #ffffff;
                                    margin: auto;" class="tac" style="" name="payment" value="2" type="submit">
                                        <p class="ttu fHelveticaNeueB fs15">Login Google</p>
                                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
