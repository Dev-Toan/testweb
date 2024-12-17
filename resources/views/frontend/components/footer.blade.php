<div id="serviceSup">
    <div class="wrp">
        <div class="group">
            <div class="item">
                <div class="flex">
                    <div class="img">
                        <img data-src="{{ asset('frontend/images/sup1.png') }}" alt="Ship" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </div>
                    <div class="text">
                        <p class="ttu fRobotoB">GIAO HÀNG MIỄN PHÍ</p>
                        <p>Thanh toán (COD) tại nhà</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="flex">
                    <div class="img">
                        <img data-src="{{ asset('frontend/images/sup2.png') }}" alt="Doi san pham" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </div>
                    <div class="text">
                        <p class="ttu fRobotoB">30 NGÀY ĐỔI SẢN PHẨM</p>
                        <p>Miễn phí</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="flex">
                    <div class="img">
                        <img data-src="{{ asset('frontend/images/sup3.png') }}" alt="Bao hanh" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </div>
                    <div class="text">
                        <p class="ttu fRobotoB">BẢO HÀNH QUỐC TẾ</p>
                        <p>Vệ sinh giày miễn phí</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="flex">
                    <div class="img">
                        <img data-src="{{ asset('frontend/images/sup4.png') }}" alt="Hoa don do" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </div>
                    <div class="text">
                        <p class="ttu fRobotoB">CHÍNH HÃNG 100%</p>
                        <p>Xuất hóa đơn đỏ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="SupInfo">
    <div class="wrp">
        <div class="left">
            <div class="item">
                <p class="head">Hotline</p>
                <a href="tel:0355223344" title="Hotline" class="tel">
                <span class="icon"><i class="fas fa-phone"></i></span>
                <span class="text">035.522.3344</span>
                </a>
            </div>
            <div class="item">
                <p class="head">Gọi đặt hàng</p>
                <a href="tel:0355223344" title="Hotline" class="tel">
                <span class="icon"><i class="fas fa-phone"></i></span>
                <span class="text">035.522.3344</span>
                </a>
            </div>
        </div>
        <div class="right">
            <div class="mail">
                <p class="fs17 ttu mb10">Đăng ký nhận thông tin mới</p>
                <div id="frmMail">
                    <input type="text" value="" placeholder="Nhập email của bạn tại đây" />
                    <a href="javascript://" title="" class="btnRegis">Đăng ký</a>
                </div>
            </div>
            <div class="social">
                <p class="fs17 ttu mb10">Kết nối mạng xã hội</p>
                <ul>
                    <li><a rel="nofollow" href="javascript://" title="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a rel="nofollow" href="javascript://" title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a rel="nofollow" href="javascript://" title="youtube" target="_blank"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="footer">
    <div class="wrp">
        <div class="top">
            <div class="left">
                <a href="javascript://" title="" class="titleHead active">Liên hệ</a>
                <div class="cont fs16">
                    <b>CÔNG TY CỔ PHẦN TRỰC TUYẾN NHÓM 5.</b>
                </div>
                <ul style="display: block;">
                    <li>
                        <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="text">VPGD: Cầu Diễn, Bắc Từ Liêm, Hà Nội.</span>
                    </li>
                    <li>
                        <span class="icon"><i class="fas fa-phone-volume"></i></span>
                        <a href="tel:0367530598" title="Hotline" class="text">Hotline: 035.522.3344</a>
                    </li>
                    <li>
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <a href="mailto:laravel1998bn@gmail.com" title="email" class="text">phanvanbo188@gmail.com</a>
                    </li>
                </ul>
            </div>
            <div class="mid">
                <div class="group">
                    <a href="javascript://" title="" class="titleHead">Hỗ trợ</a>
                    <ul class="menuFoot">
                        <li><a href="javascript://" title="1. Chính sách bảo hành">1. Chính sách bảo hành</a></li>
                        <li><a href="javascript://" title="2. Chính sách đổi hàng">2. Chính sách đổi hàng</a></li>
                        <li><a href="javascript://" title="3. Chính sách bảo mật">3. Chính sách bảo mật</a></li>
                        <li><a href="javascript://" title="4. Chính sách vận chuyển">4. Chính sách vận chuyển</a></li>
                        <li><a href="javascript://" title="5. Hướng dẫn thanh toán">5. Hướng dẫn thanh toán</a></li>
                        <li><a href="javascript://" title="6. Hướng dẫn mua hàng">6. Hướng dẫn mua hàng</a></li>
                    </ul>
                </div>
                <div class="group">
                    <a href="javascript://" title="" class="titleHead">Sản phẩm</a>
                    <ul class="menuFoot">
                        @foreach ($categories as $item)
                            <li><a href="{{ route('get.category.list',$item->c_slug.'-'.$item->id) }}" title="{{ $item->c_name }}">{{ $item->c_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="right">
                <a href="javascript://" title="" class="titleHead active">Danh mục</a>
                <div class="tag" style="display: block;">
                    <a href="javascript://" title="Cửa hàng">Hệ thống cửa hàng</a>
                    <a href="javascript://" title="">Góc hỏi đáp</a>
                    <a href="javascript://" title="Tin tức">Tin tức - Sự kiện</a>
                    <a href="javascript://" title="">Chứng nhận thương hiệu</a>
                    <a href="javascript://" title="About us">Giới thiệu</a>
                </div>
                <div class="dangky">
                    <a rel="nofollow" href="http://online.gov.vn/Home/WebDetails/2912" title="BTC" target="_blank">
                    <img data-src="{{ asset('frontend/images/bct2.png') }}" alt="BCT" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </a>
                    <a rel="nofollow" href="http://online.gov.vn/Home/WebDetails/2912" title="BTC" target="_blank">
                    <img data-src="{{ asset('frontend/images/bct.png') }}" alt="BCT" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                    </a>
                </div>
            </div>
        </div>
        <div class="bot">
            <p class="fRobotoB pb5 fs16">NHÓM 5 BITI'S</p>
            <h4 class="lh21">
                Nhà phân phối độc quyền các thương hiệu giày nổi tiếng thế giới: Epos Swiss, Atlantic Swiss, Diamond D, Philippe Auguste, Jacques Lemans, Citizen, Aries Gold,....
            </h4>
        </div>
    </div>
</div>
<div id="commonBot">
    <div class="wrp">
        <div class="left">
            Copyright © 2024 NHÓM 5 BITI'S
        </div>
        <ul class="right">
            <li>
                <a href="https://daugia.tv" title="Dau gia">
                <img data-src="{{ asset('frontend/images/LogoDauGia1.png') }}" alt="Dau gia" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                </a>
            </li>
            {{-- <li>
                <a href="https://www.kinhmatdangquang.vn" title="Kinh mat">
                <img data-src="{{ asset('frontend/images/LogoKinhMat1.png') }}" alt="KInh mat" class="lazy" src="{{ asset('frontend/images/lazy1.jpg') }}"/>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
