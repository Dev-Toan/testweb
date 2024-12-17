@foreach ($ratings as $item)
    <li id="r-{{ $item->id }}" class="par ">
        <div class="rh">
            <span>{{ $item->user->name ?? "[N\A]" }}</span>
            <label class="sttB"><i style="margin-right: 3px !important;" class="fa fa-check-circle"></i>Đã mua tại Bitisshop.com</label>
        </div>
        <div class="rc">
            <p>
                <span class="i-star-active">
                    @for($k=1 ; $k<=5 ; $k++)
                        <i class="fa fa-star {{ $k <= $item->r_number ? 'star-active' : 'star-null-active'  }}"></i>
                    @endfor
                </span>
                <i>
                    {{ $item->r_content }}
                </i>
            </p>
        </div>
        {{--  <div class="rcf" style="display: none;">
            <p>Bitis.com xác nhận: <label><i class="iconcom-rtusr"></i><span>Khách hàng <b class="name">Khang</b></span></label><label><i class="iconcom-rtadr"></i><span>Đã mua tại: <b>Cầu Diễn, Bắc Từ Liêm, Hà Nội</b></span></label></p>
            <div class="clr"></div>
            <label><i class="iconcom-rttime"></i><span>Mua <b>1 tháng </b> trước</span></label>
            <p></p>
        </div>  --}}
        <div class="ra">
            <a href="javascript:showRatingCmtChild('r-{{ $item->id }}');" class="cmtr" style="color:red">Báo Cáo</a>
            <span>• </span>
            <a href="javascript:likeRating({{ $item->id }});" class="cmtl" data-like="0"><i class="iconcom-like"></i>Thích</a><span>  </span>
            <a href="javascript:;" class="cmtd"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ date('H:i:s d-m-Y',strtotime($item->created_at)) }}</a>
            <div class="rtHis">
                <span class="rtHisDot" onclick="showRtHis({{ $item->id }});">...</span>
                {{--  <label class="rtHislbl hide" onclick="rtHis({{ $item->id }});">Xem lịch sử đánh giá</label>  --}}
            </div>
        </div>
    </li>
@endforeach
@if (\Request::route()->getName() == 'get.product.rating_list')
    <nav id="phantrang">
        {!! $ratings->appends($query ?? [])->links() !!}
    </nav>
@endif
