<div class="col-xs-12">
    <div class="boxRatingCmt" id="boxRatingCmt" style="margin: 50px 0px 80px 0px;">
        <div class="hrt" id="danhgia">
            <div class="tltRt ">
                <h3 data-s="92" data-gpa="4.6" data-c="20">{{ $product->pro_review_total }} đánh giá {{ $product->pro_name }}</h3>
                <form method="post" onsubmit="return false;">
                    <input class="cmtKey" type="text" placeholder="Tìm theo nội dung đánh giá" >
                    <i class="fa fa-search"></i>
                </form>
            </div>
        </div>
        <div class="toprt">
            <div class="crt">
                @php
                    if($product->pro_review_total == 0){
                        $age = 0;
                    }else{
                        $age = $product->pro_review_star / $product->pro_review_total;
                        $age = number_format($age,1,'.',',');
                    }
                @endphp
                <div class="lcrt " data-gpa="{{ $age }}">
                    <b>{{ $age }} <i class="fa fa-star star-active"></i></b>
                </div>
                <div class="rcrt">
                @foreach ($ratingDefault as $key => $item)
                    <div class="r">
                        <span class="t">{{ $key }} <i class="fa fa-star star-active"></i></span>
                        <div class="bgb">
                            <div class="bgb-in" style="width: {{ $product->pro_review_total==0 ? 0 : $item['count_number'] *100 / $product->pro_review_total  }}%"></div>
                        </div>
                        <span class="c s-filter"  data-buy="{{ $item['count_number'] }}">
                            <a href="{{ request()->fullUrlWithQuery(['s'=>$key]) }}">
                                <strong>{{ $item['count_number'] }}</strong> đánh giá
                            </a>
                        </span>
                    </div>
                @endforeach
                </div>
                <div class="bcrt">
                    {{--  <a href="javascript:void(0);" class="">{{ $product->pro_review_total }} đánh giá {{ $product->pro_name }}</a>  --}}
                    <a href="javascript:void(0);" id="js-rating-show-hide" class="{{ !Auth::id() ? 'js-show-login' : 'js-show-rating' }}"> Đánh giá </a>
                    {{--    --}}
                </div>
            </div>
            <div class="clr"></div>
            <form id="form-review" action="{{ route('ajax_post.user.rating.add') }}" method="POST" class="input"  style="display: none;">
                @csrf
                {{--  <input name="utf8" type="hidden" value="true">  --}}
                {{--  <input type="hidden" name="hdfRatingImg" class="hdfRatingImg">  --}}
                {{--  <input type="hidden" name="hdfIsShare" id="hdfIsShare" value="0">  --}}
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="review" id="review_value" value="5">
                <div class="ips">
                    <span>Chọn đánh giá của bạn</span>
                    <span class="lStar" id="ratings">
                    @for($i = 1 ; $i <=5 ; $i++)
                        <i  class="fa fa-star star-active" data-i={{ $i }}></i>
                    @endfor
                    </span>
                    <span class="rsStar" id="reviews-text">Tuyệt Vời</span>
                </div>
                <div class="fcm" style="margin-top: 30px;">
                    <div class="form-coment margin-bottom-30">
                        <div class="row">
                            <textarea id="txtEditor" name="content_review" cols="" rows="" class="parent_input txtEditor" placeholder="Mời bạn để lại bình luận..." ></textarea>
                            <div class="col-sm-12 margin-top-15">
                                <button type="submit" class="btn-45-orange {{ !Auth::id() ? 'js-show-login' : 'js-process-review' }}">Gửi bình luận</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
            </form>
        </div>
        <div class="list">
            @if (\Request::route()->getName() == 'get.product.rating_list')
                @include('frontend.pages.product_detail.include._inc_filter')
            @endif
            <ul class="ratingLst">
                @include('frontend.pages.product_detail.include._inc_list_reviews')
            </ul>
            <div class="clr"></div>
            <div class="pgrc">
            @if($product->pro_review_total > 0)
                @if (!(\Request::route()->getName() == 'get.product.rating_list'))
                    <a style="display: inline-block;padding: 5px 20px;
                    color: #288ad6;border: solid 1px #288ad6;
                    border-radius: 3px;text-align: center;
                    box-sizing: border-box;margin: 0 0 20px;" class="rtpLnk" href="{{ route('get.product.rating_list',$product->pro_slug . '-' . $product->id) }}" class="btn-load-rating" data-orglnk="">Xem tất cả đánh giá<span style="margin-left: 10px;font-size: 18px;">›</span></a>
                @else
                    {{--  <div class="pagcomment">{!! $ratings->appends($query ?? [])->links() !!}</div>  --}}
                @endif
            @endif
            </div>
        </div>

    </div>
</div>
