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
                        <div class="c000 fSFUHelveticaCondensedBold ttu fs20 pb20" style="text-align: center;color: #288ad6;">Forgot - Password</div>
                        <p class="fsti pb10 tac">Lưu ý: Các ô có dấu <span class="cRed">(*)</span> cần điền đầy đủ thông tin</p>
                        <div class="form" style="width: 60%;margin: auto;">
                            <form class="from_cart_register" method="post">
                                @csrf
                                <div class="item">
                                    <p class="label">Eamil <span class="cRed">(*)</span></p>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Nhập Eamil" required />
                                    @if ($errors->first('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="cb h10"></div>
                                <div class="btnThanhToan">
                                    <button class="tac" type="submit" style="margin: auto;">
                                        <p class="ttu fHelveticaNeueB fs15">Forgot Password</p>
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
