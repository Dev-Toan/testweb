@extends('layout.master_frontend')
@section('css')
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/product_ratings.css') }}">
@endsection
@section('content')


<div id="pageway" style="padding: 0 0 5px 0;">
    <div class="wrp">
        <ul>
            <li><a href="{{ route('get.category.list',$product->category->parent->c_slug.'-'.$product->category->parent->id) }}" title="{{ $product->category->parent->c_name }}"><b>{{ $product->category->parent->c_name }}</b></a></li>
            <li><a href="{{ route('get.category.list',$product->category->c_slug.'-'.$product->category->id) }}" title="{{ $product->category->c_name }}" style="color: #288ad6">{{ $product->category->c_name }}</a></li>
            <li><a href="{{ route('get.type.product.list',$product->typeproduct->tp_slug.'-'.$product->typeproduct->id) }}" title="{{ $product->typeproduct->tp_name }}" style="color: #288ad6">{{ $product->typeproduct->tp_name }}</a></li>
            <li><a href="{{ route('get.product.detail',$product->pro_slug.'-'.$product->id) }}" title="" rel="nofollow"><span class="fRobotoB" style="color:#ff5722">{{ $product->pro_name }}</span></a></li>
        </ul>
    </div>
</div>
<div class="cb"></div>

<div id="container" style="margin-top: -50px;">
    <div id="product">
        <div class="wrp">
            <div class="detailPro" style="padding-bottom: 10px;">
                @include('frontend.pages.product_detail.include._inc_ratings')
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
            //$('.pagination a').on('click', function(e) {
            $('body').on('click','.pagination a',function(e){
                e.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                //var page = $(this).attr('href').split('page=')[1];
                var URL = $(this).attr('href');
                //window.history.pushState("", "", URL);
                getPosts(URL);
          });


        $('body').on('click','.s-filter a',function(e){
            e.preventDefault();
            $('li').removeClass('act');
            $(this).parent('li').addClass('act');
            var URL = $(this).attr('href');
            //console.log(URL);
            getPosts(URL);
        });

        function getPosts(URL){
            $.ajax({
                type: "GET",
                url: URL
            })
            .success(function(results) {
                //console.log(results.data);
                $('.ratingLst').html(results.data);
            });
        }

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


        });



    </script>
@endsection