<!DOCTYPE html>
<html xmlns="">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Shop Hải AnhShop - Thanh toán đơn hàng" />
    <title>
        {{ $title_page ?? "Hi !" }}
    </title>
  <link rel="icon" href="{{ asset('uploads/cauhinh/45044255_89786203_favicon.jpg') }}" type="image/x-icon" />
  <link href="{{ asset('frontend/checkout/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css' />
  <link href="{{ asset('frontend/checkout/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css' />
  <link href="{{ asset('frontend/checkout/css/thankyou.css') }}" rel='stylesheet' type='text/css' />
  <link href="{{ asset('frontend/checkout/css/checkout.css') }}" rel='stylesheet' type='text/css' />

  <script>
    (function() {
        function asyncLoad() {
          var urls = ["{{ asset('frontend/checkout/js/productreviews.min.js') }}"];
          for (var i = 0; i < urls.length; i++) {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = urls[i];
            s.src = urls[i];
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
          }
        }
        window.attachEvent ? window.attachEvent('onload', asyncLoad) : window.addEventListener('load', asyncLoad, false);
      })();
    </script>
  </head>
  <body class="body--custom-background-color ">
    @if(Session('success'))
    <div context="checkout" define="{checkout: new Bizweb.StoreCheckout(this,{})}" class="container">
      <div class="header">
        <div class="wrap">
          <div class="shop logo logo--left ">
            <h1 class="shop__name">
              <a href="{{ url('/') }}" class="cartDestroy">
                Nhóm 5 Shop
              </a>
            </h1>
          </div>
        </div>
      </div>
      <div class="main">
        <div class="wrap clearfix">
          <div class="row thankyou-infos">
            <div class="col-md-7 thankyou-message">
              <div class="thankyou-message-icon unprint">
                <div class="icon icon--order-success svg">
                  <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                    <g fill="none" stroke="#8EC343" stroke-width="2">
                      <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                      <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                    </g>
                  </svg>
                </div>
              </div>
              <div class="thankyou-message-text">
                <h3>Cảm ơn bạn đã đặt hàng</h3>
                <p>
                  Một email xác nhận đã được gửi tới {{Session('email')}}. Xin vui lòng kiểm tra email của bạn
                </p>
                <div style="font-style: italic;">
                </div>
              </div>
            </div>
            <div class="col-md-5 col-sm-12 order-info" define="{order_expand: false}">
              <div class="order-summary order-summary--custom-background-color ">
                <div class="order-summary-header summary-header--thin summary-header--border">
                  <h2>
                    <label class="control-label">Đơn hàng</label>
                    <label class="control-label unprint">({{ Cart::count() }})</label>
                  </h2>
                  <a class="underline-none expandable expandable--pull-right mobile unprint" bind-event-click="toggle(this, '.order-items')" bind-class="{open: order_expand}" href="javascript:void(0)">
                    Xem chi tiết
                  </a>
                </div>
                <div class="order-items mobile--is-collapsed" bind-class="{'mobile--is-collapsed': !order_expand}">
                  <div class="summary-body summary-section summary-product">
                    <div class="summary-product-list">
                      <ul class="product-list">
                        @foreach ($cart as $items)
                          <li class="product product-has-image clearfix">
                            <div class="product-thumbnail pull-left">
                                <div class="product-thumbnail__wrapper">
                                    <img src="{{ pare_url_file($items->options->image) }}" alt="{{ $items->name }}" class='product-thumbnail__image' />
                                </div>
                                <span class="product-thumbnail__quantity unprint" aria-hidden="true">{{ $items->qty }}</span>
                            </div>
                            <div class="product-info pull-left">
                                <span class="product-info-name">
                                    <strong>{{ $items->name }}</strong>
                                    <label class="print">x{{ $items->qty }}</label>
                                </span>
                            </div>
                            <strong class="product-price pull-right"> {{ number_format($items->price,0,',','.') }}₫ </strong>
                        </li>
                        @endforeach

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="summary-section  border-top-none--mobile ">
                  <div class="total-line total-line-subtotal clearfix">
                    <span class="total-line-name pull-left">
                      Tạm tính
                    </span>
                    <span class="total-line-subprice pull-right">
                      {{ $total }}₫
                    </span>
                  </div>
                  <div class="total-line total-line-shipping clearfix">
                    <span class="total-line-name pull-left">
                      Phí vận chuyển
                    </span>
                    <span class="pull-right">
                      Miễn phí
                    </span>
                  </div>
                </div>
                <div class="summary-section">
                  <div class="total-line total-line-total clearfix">
                    <span class="total-line-name total-line-name--bold pull-left">
                      Tổng cộng
                    </span>
                    <span class="total-line-price pull-right">
                      {{ $total }}₫
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7 col-sm-12 customer-info">
              {{-- <div define="{viewmaps: new Bizweb.ViewMaps('18.9749443','73.96831020000002','AIzaSyDWReBlPxFt-i145Gsd502wOqRS0KXFHW4;AIzaSyAbtwApDToQWn7snVio3Y9PWFbcpdnOWdk;AIzaSyA5rJOu8wci0li24bnZ1WogMEH93p-DGlM')}">
                <div id="map"></div>
              </div> --}}
              <div class="shipping-info">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="order-summary order-summary--white no-border no-padding-top">
                      <div class="order-summary-header">
                        <h2>
                          <label class="control-label">Thông tin nhận hàng</label>
                        </h2>
                      </div>
                      <div class="summary-section no-border no-padding-top">
                        <p class="address-name">
                          {{Session('name')}}
                        </p>
                        <p class="address-address">
                          {{Session('email')}}
                        </p>
                        <p class="address-district">
                          {{Session('address')}}
                        </p>
                        <p class="address-phone">
                          {{Session('phone')}}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div class="order-summary order-summary--white no-border">
                      <div class="order-summary-header">
                        <h2>
                          <label class="control-label">Hình thức thanh toán</label>
                        </h2>
                      </div>
                      <div class="summary-section no-border no-padding-top">
                        <span>{{Session('tt')}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div class="order-summary order-summary--white no-border">
                      <div class="order-summary-header">
                        <h2>
                          <label class="control-label">Hình thức vận chuyển</label>
                        </h2>
                      </div>
                      <div class="summary-section no-border no-padding-top">
                        <span>Giao hàng tận nơi - Miễn phí</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="order-success unprint">
                <a href="{{ url('/') }}" class="btn btn-primary cartDestroy">
                  Tiếp tục mua hàng
                </a>
                {{-- <a onclick="window.print()" class="nounderline print-link" href="javascript:void(0)">
                  <div class="print-link__block clearfix">
                    <i class="fa fa-print icon-print" aria-hidden="true"></i>
                    In
                  </div>
                </a> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="main_footer footer unprint">
          <div class="mt10"></div>
        </div>
      </div>
    </div>
    @endif
    <style>
    #map {
      width: 100%;
      height: 245px;
    }
    .hidden-map{
      display:none;
    }
  </style>

  <script src='https://bizweb.dktcdn.net/assets/themes_support/thankyou.js?20171025' type='text/javascript'></script>

  <script src="{{ asset('frontend/checkout/js/jquery-2.1.3.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('frontend/checkout/js/bootstrap.min.js') }}" type='text/javascript'></script>
  <script src="{{ asset('frontend/checkout/js/twine.min.js') }}" type='text/javascript'></script>


  <script src="{{ asset('frontend/checkout/js/checkout.js') }}" type='text/javascript'></script>
  <script src="{{ asset('frontend/checkout/js/thankyou.js') }}" type='text/javascript'></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.cartDestroy').click(function(e){
        e.preventDefault();
        // alert('ok');
        $.get('delete_all_shopping',function(data){
          window.location.href = '/';
        });
      });
    });
  </script>
  <script type="text/javascript">
    context = {}

    $(function () {
      Twine.reset(context).bind().refresh();
    });

    window.Bizweb || (window.Bizweb = {});
    Bizweb.Checkout = function () {
      function Checkout(e, options) {
        if (!options)
          options = {};

        this.ele = e;
        this.invalidEmail = false;
      };

      Checkout.prototype.handleClick = function (element) {
        $(element).closest(".field__input-wrapper").find(".field__input").focus();
      }

      Checkout.prototype.handleFocus = function (element) {
        $(element).closest(".field__input-wrapper").addClass("js-is-focused")
      }

      Checkout.prototype.handleFieldBlur = function (element) {
        $(element).closest(".field__input-wrapper").removeClass("js-is-focused")
      }

      Checkout.prototype.changeEmail = function () {
      }

      return Checkout;
    }();
  </script>
  <script>
    (function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({
        'gtm.start':
        new Date().getTime(), event: 'gtm.js'
      }); var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-MS77Z9');
  </script>
  <!-- End Google Tag Manager -->
</body>
</html>
