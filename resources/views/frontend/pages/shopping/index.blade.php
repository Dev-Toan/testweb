@extends('layout.master_frontend')
@section('content')
<div id="pageway" style="border-bottom: 5px solid #e5e5e5;">
    <div class="wrp">
        <ul>
            <li><a href="/" title="Home"><b>TRANG CHỦ</b></a></li>
            <li><a href="javascript://" title="Gio hang" style="color: #288ad6"><b>GIỎ HÀNG</b></a></li>
        </ul>
    </div>
</div>
<div class="cb"></div>
<link href="{{ asset('frontend/css/cart.css') }}" rel="stylesheet" />
<div id="container">
@if (Cart::count())
    <div class="wrp">
        <div id="product" class="cart">
            <div class="flex">
                <div class="left">
                    <div class="cart_header" style="text-align: center;color: #288ad6;">THÔNG TIN GIỎ HÀNG</div>
                    <form name="frm_cart" action="" method="post">
                        <div class="tableCart">
                            <div class="row row1">
                                <div class="col col1"></div>
                                <div class="flex flex_1">
                                    <div class="col col2 dnmobile">Sản phẩm</div>
                                    <div class="flex flex_1 dnmobile">
                                        <div class="col col3">Giá</div>
                                        <div class="col col4">Số lượng</div>
                                        <div class="col col5">Thành tiền</div>
                                        <div class="col col6"></div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($shopping as $key => $item)
                                <div class="row row2 productid-{{ $key }}" style="display: block;">
                            
                                    <div class="flex flex_1">
                                        <div class="col col1">
                                            <div class="wImage">
                                                <a href="{{ route('get.product.detail',Str::slug($item->name).'-'.$item->id) }}" title="" class="image"> <img data-src="{{ pare_url_file($item->options->image) }}" class="lazy" alt="" src="{{ asset('frontend/images/lazy1.jpg') }}" /> </a>
                                            </div>
                                        </div>
                                        <div class="col col2">
                                            <a href="{{ route('get.product.detail',Str::slug($item->name).'-'.$item->id) }}" title="" class="fHelveticaNeueB">{{ $item->name }}</a>
                                        </div>
                                        <div class="col col3">
                                            <span class="fs16">
                                                    <p><b>{{ number_format($item->options->price_old,0,',','.') }} </b></p>
                                                    @if ($item->options->sale)
                                                        <p style="background: #F00;padding: 5px 5px;color: #FFF;border-radius: 25px;text-transform: uppercase;font-weight: bold;width: 80px;text-align: center;">- {{ $item->options->sale }} %</p>
                                                    @endif
                                            </span>
                                        </div>
                                        <div class="col col4"> <span class="dn dibmobile pr4">Số lượng: </span>
                                            <input type="number" min="1" class="input_quantity" name="quantity_{{ $item->id }}" value="{{ $item->qty }}" id="quantity_{{ $item->id }}" />
                                            {{--  <input type="button" class="update_qty btn btn-danger fff" value="Cập nhật"  />  --}}
                                            <p data-id-product="{{ $item->id }}" data-id-item={{ $key }}  data-url="{{ route('ajax_get.shopping.update',$key) }}">
                                                <button type="button" style="border: 1px solid #d5d5d5;border-radius: 3px;
                                                box-sizing: border-box;height: 30px;padding: 0 10px;width: 30px;" class="js-reduction">-</button>
                                                <button type="button" style="border: 1px solid #d5d5d5;border-radius: 3px;
                                                box-sizing: border-box;height: 30px;padding: 0 10px;width: 30px;" class="js-increase">+</button>
                                            </p>
                                        </div>
                                        <div class="col col5">
                                            <span class="dn dibmobile pr4">Thành tiền: </span>

                                            <span class="fs16 fwb js-total-item-{{ $key }}">{{ number_format($item->price * $item->qty,0,',','.') }}</span>
                                        </div>
                                        <div class="col col6">
                                            <a data-rowID-item="{{ $key }}" class="btnDelete js-remove-item" href="{{ route('get.shopping.delete',$key) }}" > <img data-src="{{ asset('frontend/images/delete.jpg') }}" class="lazy" alt="" src="{{ asset('frontend/images/lazy1.jpg') }}" /> </a>
                                        </div>
                                    </div>
                                    <div class="col col7 size-buttons">
                                        <label for="size_{{ $item->id }}" class="size-label">Chọn Size:</label>
                                        <select id="size_{{ $item->id }}" class="select-size">
                                            <option value="">-- Chọn size --</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                        </select>
                                    </div>
                                </div>
                                
                            @endforeach
                            
                            <div class="row row3">
                                <div class="totalPrice">Thanh toán: <span id="payOrder">{{ Cart::subtotal(0) }} </span> VNĐ </div>
                            </div>
                            {{--  <input type="hidden" name="hdntotal" id="hdntotal" value="8690000">  --}}
                            <div class="row row3">
                                <div class="lienhe">
                                    <p>Thông tin liên hệ Hotline: <a href="tel:0355223344" title="0355223344">0355223344</a>  </p>
                                    <p>Xin trân trọng cảm ơn !</p>
                                </div>
                            </div>
                        </div>
                        <div class="cb"></div>
                        <div class="btnCartGroup tac" style="margin-top: 30px;"> <a href="{{ route('get.home') }}" class="btnCart" title="" style="background: #3498db;padding: 10px 15px;color: #FFF;border-radius: 25px;text-transform: uppercase;">Mua thêm sản phẩm khác  </a> </div>
                    </form>
                </div>
                <div class="infoDatHang flex_1">
                    <div class="group">
                        @if (Auth::check())
                            @if (Auth::user()->email_verified_at)
                                <div class="c000 fSFUHelveticaCondensedBold ttu fs20 pb20" style="text-align: center;color: #288ad6;">BẠN ĐÃ ĐĂNG NHẬP</div>
                                <p class="fsti pb10 tac">Nên Chúng Tôi Đã Lấy Thông Tin Theo Tài Khoản Bạn Đăng Ký</p>
                                <p class="fsti pb10 tac">Lưu ý: Các ô có dấu <span class="cRed">(*)</span> cần điền đầy đủ thông tin</p>
                                <div class="form">
                                    <form class="from_cart_register" action="{{ route('post.shopping.pay') }}" method="post">
                                        @csrf
                                            <div class="item">
                                                <p class="label">Họ và tên <span class="cRed">(*)</span></p>
                                                <input type="text" name="tst_name" id="txt_name" placeholder="Nhập họ tên" value="{{Auth::user()->name}}" required oninvalid="this.setCustomValidity('Vui lòng nhập họ tên!')" oninput="setCustomValidity('')" />
                                            </div>
                                            <div class="item">
                                                <p class="label">Điện thoại <span class="cRed">(*)</span></p>
                                                <input type="text" name="tst_phone" id="txt_phone" placeholder="Nhập điện thoại" value="{{Auth::user()->phone}}" required oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại')" oninput="setCustomValidity('')" />
                                            </div>
                                            <div class="item">
                                                <p class="label">Địa chỉ <span class="cRed">(*)</span></p>
                                                <input type="text" value="{{Auth::user()->address}}" name="tst_address" id="txt_address" placeholder="Nhập địa chỉ" required oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ!')" oninput="setCustomValidity('')" />
                                            </div>
                                            <div class="item">
                                                <p class="label">Email</p>
                                                <input type="text" name="tst_email" value="{{Auth::user()->email}}" readonly/>
                                            </div>
                                        <div class="item">
                                            <p class="label">Nội dung</p>
                                            <textarea style="min-height: 60px;" name="tst_note" cols="" rows="2"></textarea>
                                        </div>
                                        <div class="cb h10"></div>
                                        <div class="btnThanhToan " > 
                                            <button   class="tac"  type="submit" name="pay" value="1">
                                                <p class="ttu fHelveticaNeueB fs15">ĐẶT HÀNG THANH TOÁN SAU</p>
                                                <p>(Trả tiền khi nhận hàng tại nhà)</p>
                                            </button>
                                            <!-- <button class="tac"  type="submit" name="pay" value="2">
                                                <p class="ttu fHelveticaNeueB fs15">Thanh toán online</p>
                                                <p>(Thông qua VNPAY-QR-CODE)</p>
                                            </button> -->
                                        </div>
                                    </form>
                                </div>
                            @else
                                <p class="fsti pb10 tac" style="color: rgb(0, 89, 255)">Bạn Chưa Verify Email ! Nên KHông Thể Mua .</p>
                                <p>Click <a style="color: red" href="{{ route('get.user.update_info') }}">vào đây</a> để lấy lại link verify email !</p>

                            @endif
                        @else
                            {{-- <div class="c000 fSFUHelveticaCondensedBold ttu fs20 pb20" style="text-align: center;color: #288ad6;">THÔNG TIN LIÊN HỆ</div>
                            <p class="fsti pb10 tac">Lưu ý: Các ô có dấu <span class="cRed">(*)</span> cần điền đầy đủ thông tin</p>
                            <div class="form">
                                <form class="from_cart_register" action="{{ route('post.shopping.pay') }}" method="post">
                                    @csrf
                                        <div class="item">
                                            <p class="label">Họ và tên <span class="cRed">(*)</span></p>
                                            <input type="text" name="tst_name" id="txt_name" placeholder="Nhập họ tên" value="" required oninvalid="this.setCustomValidity('Vui lòng nhập họ tên!')" oninput="setCustomValidity('')" />
                                        </div>
                                        <div class="item">
                                            <p class="label">Điện thoại <span class="cRed">(*)</span></p>
                                            <input type="text" name="tst_phone" id="txt_phone" placeholder="Nhập điện thoại" value="" required oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại')" oninput="setCustomValidity('')" />
                                        </div>
                                        <div class="item">
                                            <p class="label">Địa chỉ <span class="cRed">(*)</span></p>
                                            <input type="text" value="" name="tst_address" id="txt_address" placeholder="Nhập địa chỉ" required oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ!')" oninput="setCustomValidity('')" />
                                        </div>
                                        <div class="item">
                                            <p class="label">Email</p>
                                            <input type="text" name="tst_email" value="" />
                                        </div>
                                    <div class="item">
                                        <p class="label">Nội dung</p>
                                        <textarea style="min-height: 60px;" name="tst_note" cols="" rows="2"></textarea>
                                    </div>
                                    <div class="cb h10"></div>
                                    <div class="btnThanhToan">
                                        <button class="tac"  type="submit">
                                            <p class="ttu fHelveticaNeueB fs15">ĐẶT HÀNG THANH TOÁN SAU</p>
                                            <p>(Trả tiền khi nhận hàng tại nhà)</p>
                                        </button>
                                        <button class="tac"  type="submit">
                                            <p class="ttu fHelveticaNeueB fs15">Thanh toán online</p>
                                            <p>(Bằng thẻ ATM, Visa, Master)</p>
                                        </button>
                                    </div>
                                </form>
                            </div> --}}
                            <p class="fsti pb10 tac" style="color: rgb(0, 89, 255)">Bạn Chưa Đăng nhập ! Nên KHông Thể Mua .</p>
                            <p>Click <a style="color: red" href="{{ route('get.login') }}">vào đây</a> để lấy Đăng nhập !</p>
                        @endif

                    </div>
                    <div class="cb"></div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="wrp">
        <div id="product" class="cart">Bạn chưa có sản phẩm nào trong giỏ hàng!</div>
    </div>
@endif
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){

            // xóa sản phẩm bằng ajax
            $(document).on('click','.js-remove-item',function(e){
                e.preventDefault();
                let $this = $(this);
                let URL =$this.attr('href');
                let rowIDitem=$this.attr('data-rowID-item');

                if(URL){
                    $.ajax({
                        url:URL,
                        success:function(results){
                            toastr.warning(results.data);
                            $('#payOrder').text(results.total);
                            //console.log(results.data);
                            $('.productid-' + rowIDitem).remove();
                            $('.js-update-qty').text(results.total_qty);
                        },
                        error:function(error){
                            console.log(error.messages);
                        }
                    });
                }
            });

            //update qty banphim
            $(document).on('change','.input_quantity',function(e){
                let $this = $(this);
                let number = parseInt($this.val());
                let rowId = $this.next().attr('data-id-item');
                let URL = $this.next().attr('data-url');
                let productID = $this.next().attr('data-id-product');
                $.ajax({
                    url:URL,
                    data:{
                        number:number,
                        productID:productID
                    },
                    success:function(results){
                        //console.log(typeof results.total);
                        // if(typeof results.total !== "undefined"){
                        if(!results.error){
                            $this.val(number);
                            $('#payOrder').text(results.total);
                            toastr.success(results.data);
                            $('.js-update-qty').text(results.total_qty);
                            $this.parents('form').find('.js-total-item-'+rowId).text(results.totalitem);
                        }else{
                            $this.val(1);
                            toastr.error(results.data);
                            $('#payOrder').text(results.total);
                            $('.js-update-qty').text(results.total_qty);
                            $this.parents('form').find('.js-total-item-'+rowId).text(results.totalitem);
                        }
                    },
                    error:function(error){
                        console.log(error.messages);
                    }
                });
            });


            // tăng số lượng sản phẩm
            $('.js-increase').click(function(){
                let $this = $(this);
                let $input = $this.parent().prev();
                let number = parseInt($input.val());
                //let price = $this.parent().attr('data-price');
                let rowId = $this.parent().attr('data-id-item');
                let URL = $this.parent().attr('data-url');
                let productID = $this.parent().attr('data-id-product');
                number +=1;
                //let $totalItem =

                $.ajax({
                    url:URL,
                    data:{
                        number:number,
                        productID:productID
                    },
                    success:function(results){
                       
                        console.log(results);
                        if(!results.error){
                            $input.val(number);
                            $('#payOrder').text(results.total);
                            toastr.success(results.data);
                            $('.js-update-qty').text(results.total_qty);
                            $this.parents('form').find('.js-total-item-'+rowId).text(results.totalitem);
                        }else{
                            $input.val(1);
                            toastr.error(results.data);
                            $('#payOrder').text(results.total);
                            $('.js-update-qty').text(results.total_qty);
                            $this.parents('form').find('.js-total-item-'+rowId).text(results.totalitem);
                        }
                    },
                    error:function(error){
                        console.log(error.messages);
                    }
                });
            });


            // Giảm số lượng sản phẩm
            $('.js-reduction').click(function(){
                let $this = $(this);
                let $input = $this.parent().prev();
                let number = parseInt($input.val());

                if(number <= 1){
                    toastr.warning('Số Lượng Phải lớn hơn 1 nhen !');
                    return false;
                }

                let rowId = $this.parent().attr('data-id-item');
                let URL = $this.parent().attr('data-url');
                let productID = $this.parent().attr('data-id-product');
                number = number-1;

                $.ajax({
                    url:URL,
                    data:{
                        number:number,
                        productID:productID
                    },
                    success:function(results){
                        //console.log(typeof results.total);
                        if(typeof results.total !== "undefined"){
                            $input.val(number);
                            $('#payOrder').text(results.total);
                            toastr.success(results.data);
                            $('.js-update-qty').text(results.total_qty);
                            $this.parents('form').find('.js-total-item-'+rowId).text(results.totalitem);
                        }else{
                            $input.val(number + 1);
                            toastr.error(results.data);
                        }
                    },
                    error:function(error){
                        console.log(error.messages);
                    }
                });
            });
        });
    </script>
@endsection
