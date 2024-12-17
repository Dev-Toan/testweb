<span style="font-size: x-large;" >Tên Sản Phẩm : </span> <p>{{ $rating->product->pro_name }}</p>
<span style="font-size: x-large;">Author : </span> <p>{{ $rating->user->name }}</p>
<span style="font-size: x-large;">Star : </span> <div class="ratings">
    @for($i = 1 ; $i <= 5 ; $i++)
        <span class="{{ $i <= $rating->r_number ? 'active' : '' }}"><i class="fa fa-star"></i></span>
    @endfor
</div>
<span style="font-size: x-large;">Nội Dung : </span> <p>{{$rating->r_content}}</p>
<span style="font-size: x-large;">Ngày Tạo : </span> <p>{{$rating->updated_at}}</p>
