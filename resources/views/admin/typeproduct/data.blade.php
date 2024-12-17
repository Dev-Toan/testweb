<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tbody>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>category</th>
          <th>Avatar</th>
          <th>Status</th>
          <th>Hot</th>
          <th>Time</th>
          <th>Action</th>
        </tr>
        @if(isset($type_products))
            @foreach ($type_products as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->tp_name }}</td>
                    <td>{{ $item->category->c_name }}</td>
                    <td><img src="{{ pare_url_file($item->tp_avatar) }}" alt="" width="150px" height="100px"> </td>
                    <td>
                        @if ($item->tp_status==1)
                            <a href="{{ route('admin.typeproduct.active',$item->id) }}" class="label label-info status-active">show</a>
                        @else
                             <a href="{{ route('admin.typeproduct.active',$item->id) }}" class="label label-default status-active">hide</a>
                        @endif
                    </td>
                    <td>
                        @if ($item->tp_hot==1)
                            <a href="{{ route('admin.typeproduct.hot',$item->id) }}" class="label label-info status-active">Hot</a>
                        @else
                             <a href="{{ route('admin.typeproduct.hot',$item->id) }}" class="label label-default status-active">None</a>
                        @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.typeproduct.update',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="{{ route('admin.typeproduct.delete',$item->id) }}" class="btn btn-xs btn-danger js-delete-confirm"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        @endif
      </tbody>
    </table>
    {!! $type_products->appends($query ?? [])->links() !!}
  </div>
