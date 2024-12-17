<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tbody>
        <tr>
          <th>STT -- ID</th>
          <th>Name</th>
          <th>SL - còn</th>
          <th>Category</th>
          <th>Avatar</th>
          <th>Price</th>
          <th>Hot</th>
          <th>Status</th>
          <th>Times</th>
          <th>Action</th>
        </tr>
        @php
           $i = 0;
        @endphp
        @if(isset($products))
            @foreach ($products as $item)
                <tr>
                    <td>{{ ++$i . ' -- ' .  $item->id}}</td>
                    <td>{{ $item->pro_name }}</td>
                    <td>{{ $item->pro_number }} - {{ ($item->pro_number-$item->pro_pay) }}</td>
                    <td><span class="label label-warning">{{ $item->category->c_name ?? "[N\A]" }}</span></td>
                    <td><img src="{{ pare_url_file($item->pro_avatar) }}" alt="" width="150px" height="100px"> </td>
                    <td>
                        @if ($item->pro_sale)
                            <span class="label label-default" style="text-decoration: line-through;">{{ number_format($item->pro_price,0,',','.') }} VND</span><br>
                            @php
                                $price  =$item->pro_price * ((100-$item->pro_sale)/100);
                            @endphp
                            <span class="label label-success">{{ number_format($price,0,',','.') }} VND</span><br>
                            <span >Giảm  {{ $item->pro_sale }}%</span>
                        @else
                            <span class="label label-success">{{ number_format($item->pro_price,0,',','.') }} VND</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->pro_hot==1)
                            <a href="{{ request()->fullUrlWithQuery(['p_hot'=>1, 'p_id' => $item->id, 'p_status' => -1]) }}" class="label label-info status-actives">Hot</a>
                        @else
                             <a href="{{ request()->fullUrlWithQuery(['p_hot'=>2, 'p_id' => $item->id, 'p_status' => -1]) }}" class="label label-default status-actives">None</a>
                        @endif
                    </td>
                    <td>
                        @if ($item->pro_active==1)
                            <a href="{{ request()->fullUrlWithQuery(['p_status'=>1, 'p_id' => $item->id, 'p_hot'=> -1]) }}" class="label label-info status-actives">Active</a>
                        @else
                             <a href="{{ request()->fullUrlWithQuery(['p_status'=>2, 'p_id' => $item->id, 'p_hot'=> -1]) }}" class="label label-default status-actives">Hide</a>
                        @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.product.update',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="{{ route('admin.product.delete',$item->id) }}" class="btn btn-xs btn-danger js-delete-confirm"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        @endif
      </tbody>
    </table>
  <div>{!! $products->appends($query ?? [])->links() !!}</div>
  </div>
