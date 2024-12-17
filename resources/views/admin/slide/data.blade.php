<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tbody>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Banner</th>
          <th>Status</th>
          <th>Sort</th>
          <th>Target</th>
          <th>Action</th>
        </tr>
        @if(isset($slides))
            @foreach ($slides as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->sd_title }}</td>
                    <td>
                        <img src="{{ pare_url_file($item->sd_image) }}" alt="" width="150px" height="100px">
                    </td>
                    <td>
                        @if ($item->sd_active==1)
                            <a href="{{ route('admin.slide.active',$item->id) }}" class="label label-info status-active">show</a>
                        @else
                             <a href="{{ route('admin.slide.active',$item->id) }}" class="label label-default status-active">hide</a>
                        @endif
                    </td>
                    <td>{{ $item->sd_sort }}</td>
                    <td>{{ $item->sd_target }}</td>
                    <td>
                        <a href="{{ route('admin.slide.update',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="{{ route('admin.slide.delete',$item->id) }}" class="btn btn-xs btn-danger js-delete-confirm"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        @endif
      </tbody>
    </table>
  {{--  <div>{!! $slides->links() !!}</div>  --}}
  </div>
