@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Menu
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.menu.index') }}">Menu</a></li>
      <li class="active">list</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Thêm mới </a></h3>
                <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>ID</th>
                      <th>name</th>
                      <th>Avatar</th>
                      <th>Status</th>
                      <th>Hot</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                    @if($menus)
                        @foreach ($menus as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->mn_name }}</td>
                                <td>{{ $item->mn_avatar }}</td>
                                <td>
                                    @if ($item->mn_status==1)
                                        <a href="{{ route('admin.menu.active',$item->id) }}" class="label label-info">show</a>
                                    @else
                                         <a href="{{ route('admin.menu.active',$item->id) }}" class="label label-default">hide</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->mn_hot==1)
                                        <a href="{{ route('admin.menu.hot',$item->id) }}" class="label label-info">Hot</a>
                                    @else
                                         <a href="{{ route('admin.menu.hot',$item->id) }}" class="label label-default">None</a>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.menu.update',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{ route('admin.menu.delete',$item->id) }}" class="btn btn-xs btn-danger js-delete-confirm"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              {{--  <div>{!! $menus->links() !!}</div>  --}}
            </div>
            <!-- /.box -->
          </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
  </section>
  <!-- /.content -->
@endsection
