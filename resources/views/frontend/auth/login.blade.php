@extends('layout.master_frontend')
@section('content')
    <div id="pageway" style="border-bottom: 5px solid #e5e5e5;">
        <div class="wrp">
            <ul>
                <li><a href="/" title="Home"><b>TRANG CHỦ</b></a></li>
                <li><a href="javascript://" title="Đăng Nhập" style="color: #288ad6"><b>Đăng Nhập</b></a></li>
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
                            <div class="c000 fSFUHelveticaCondensedBold ttu fs20 pb20" style="text-align: center;color: #288ad6;">ĐĂNG NHẬP VÔ HỆ THỐNG NÀO</div>
                            <p class="fsti pb10 tac">Lưu ý: Các ô có dấu <span class="cRed">(*)</span> cần điền đầy đủ thông tin</p>
                            <div class="form" style="width: 60%;margin: auto;">
                                <form class="from_cart_register" method="post">
                                    @csrf
                                    <div class="item">
                                        <p class="label">Email <span class="cRed">(*)</span></p>
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Nhập email" required />
                                    </div>
                                    <div class="item">
                                        <p class="label">Mật Khẩu <span class="cRed">(*)</span></p>
                                        <input type="password" name="password" value=""   placeholder="Nhập mật khẩu" required  />
                                    </div>
                                    <div class="cb h10"></div>
                                    <div class="btnThanhToan">
                                        <button class="tac" name="payment" value="1" type="submit" style="margin: auto;">
                                            <p class="ttu fHelveticaNeueB fs15">Đăng Nhập</p>
                                        </button>

                                    </div>
                                </form>
                                <div class="btnThanhToan">
                                    <button onclick="window.location.href='/forgot-password'" style="background: #0e74c2;
                                    margin: auto;" class="tac" style="" name="payment" value="2" type="submit">
                                        <p class="ttu fHelveticaNeueB fs15">Quên Mật Khẩu</p>
                                        <p>(Bạn Muốn Lấy Lại Mẩu Khẩu)</p>
                                    </button>
                                </div>
                                <div class="btnThanhToan">
                                    <button onclick="window.location.href='auth/google/url'" style="background: #ffffff;
                                    margin: auto;" class="tac" style="" name="payment" value="2" type="submit">
                                        <p class="ttu fHelveticaNeueB fs15">Login Google</p>
                                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
