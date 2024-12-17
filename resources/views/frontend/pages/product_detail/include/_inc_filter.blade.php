<div class="filter">
    <ul class="ftR s-filter">
        <li class="t">Lọc xem theo: </li>
        <li class="s s0 {{ Request::get('s') ? '' : 'act' }}" ><a href="{{ request()->fullUrlWithQuery(['s'=>0]) }}">Tất cả</a></li>
        @for($i=5; $i>=1; $i-- )
            <li class="s s{{ $i }} {{ Request::get('s') ==$i ? 'act' : '' }}" ><a href="{{ request()->fullUrlWithQuery(['s'=>$i]) }}">{{ $i }} sao</a></li>
        @endfor
    </ul>
</div>
