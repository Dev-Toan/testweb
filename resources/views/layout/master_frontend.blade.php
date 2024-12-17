<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="vi" xml:lang="vi" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <title>Giày Biti's, giày nam, giày nữ chính hãng cao cấp</title>
        @if (session('toastr'))
            <script>
                var TYPE_MESSAGE = "{{ session('toastr.type') }}";
                var MESSAGE = "{{ session('toastr.message') }}";
            </script>
        @endif
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="MobileOptimized" content="device-width" />
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <meta http-equiv="content-language" itemprop="inLanguage" content="vi"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon"/>
        <!--CSS-->
        <link rel="stylesheet" href="https://codeseven.github.io/toastr/build/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
        <link href="{{ asset('frontend/css/display.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/fontawesome-all.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/font.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/lightbox.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/slick.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/Common.css') }}" rel="stylesheet" />
        <!--CSS Responsive-->
        <link href="{{ asset('frontend/css/css_rwd_common.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/css_rwd.min.css') }}" rel="stylesheet" />
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <link href="{{ asset('frontend/css/dqw.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/news_css_rwd.css') }}" rel="stylesheet" />
        <script src="{{ asset('frontend/js/jquery-1.9.1.min.js') }}"></script>
        <script src="{{ asset('frontend/js/stv_new.js') }}"></script>
        @yield('css')
    </head>
    <body>

        @include('frontend.components.header')



        @yield('content')

        <div class="cb"></div>

        @include('frontend.components.footer')

        <div id="bttop">
            <span>Về đầu trang</span>
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32.635 32.635" style="enable-background:new 0 0 32.635 32.635;" xml:space="preserve">
                <g>
                    <path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5
                        S32.411,16.817,32.135,16.817z"></path>
                    <path d="M19.598,29.353c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l12.184-12.184L19.244,4.136
                        c-0.195-0.195-0.195-0.512,0-0.707s0.512-0.195,0.707,0l12.537,12.533c0.094,0.094,0.146,0.221,0.146,0.354
                        s-0.053,0.26-0.146,0.354L19.951,29.206C19.854,29.304,19.726,29.353,19.598,29.353z"></path>
                </g>
            </svg>
        </div>
        <div id="supRes" class="dn dbtablet-l">
            <a href="{{ route('get.shopping.list') }}" title="Giỏ hàng" class="item">
                <span class="icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="number js-update-qty">{{ Cart::count() }}</span>
                </span>
                <span class="text">
                    Giỏ hàng
                </span>
            </a>
            <a href="tel:18006005" title="Hotline" class="item">
                <span class="icon">
                    <img src="{{ asset('frontend/images/hotline.png') }}" alt="Hotline">
                </span>
                <span class="text">
                    0355223344
                </span>
            </a>
            <a href="javascript://" title="Khuyen mai" class="item">
                <span class="icon">
                    <img src="{{ asset('frontend/images/hotline.png') }}" alt="Hotline">
                </span>
                <span class="text">
                    Khuyến mãi
                </span>
            </a>
        </div>
        <div id="overlay"></div>
        <script src="{{ asset('frontend/js/lazyload.min.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/js/lightbox.min.js') }}"></script>
        <script src="{{ asset('frontend/js/slick.js') }}"></script>
        <script src="{{ asset('frontend/js/Common.js') }}"></script>
        <script src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <script>
            if(typeof TYPE_MESSAGE != "undefined"){
                switch(TYPE_MESSAGE){
                case 'success':
                    toastr.success(MESSAGE)
                    break;
                case 'error':
                    toastr.error(MESSAGE)
                    break;
                case 'warning':
                    toastr.warning(MESSAGE)
                    break;
                case 'info':
                    toastr.info(MESSAGE)
                    break;
                }
            }
            //$(function(){
            //    $('#popup-messages').modal();
            //});
        </script>

    </body>
</html>
@yield('script')


