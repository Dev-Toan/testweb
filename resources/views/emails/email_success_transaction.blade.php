<h2>Thông tin người mua hàng</h2>
<p>Người mua: <span style="color: #101010fa;font-weight: bold">{{$name}}</span></p>
<h2>Danh Sách Sản Phẩm Đã Mua</h2>
@foreach ($transactions as $item)
    <!-- <div>
        <img src="{{ pare_url_file($item->options->image) }}" alt="" width="100px" height="100px">
    </div> -->
    <div>Tên Sản Phẩm : {{ $item->name }}</div>
    <div>
        @if ($item->options->sale)
            <span>--Giảm: {{ $item->options->sale }} %</span>
            <span > Giá: {{ number_format(number_price($item->options->price_old,0),0,',','.') }}</span>
        @else
            <span class="price">Giá: {{ number_format($item->price,0,',','.') }}₫</span>
        @endif
    </div>
    <div>Số Lượng: {{ $item->qty }}</div>
    <br><br><br><br><br>
@endforeach
<h2>Tổng Tiền: {{ \Cart::subtotal(0) }}</h2>
<p>Hình thức thanh toán: Thanh toán khi nhận hàng</p>
<h2>Lời nhắn</h2>
<p>Hi <span style="color: #101010fa;font-weight: bold">{{$name}}</span>.Chúng tôi đã gửi hàng cho bạn.<br/>
Bạn vui lòng chờ từ 2-4 ngày sẽ có nhân viên giao hàng gọi điện cho bạn ạ.
<p>Nếu có bất kì thắc mắc gì liên quan đến thông tin,dịch vụ.<br/>
	Vui lòng liên hệ theo số Hotline:<a href="callto:355223344" style="color: red">(+84) 355223344</a> </p>
	<p>Cảm ơn bạn đã ủng hộ Shop!</p>
  <p><span style="font-weight: bold;">Nhóm 5 Biti's</span> Thân !</p>
</p>
