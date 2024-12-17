@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
      User
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.user.index') }}">User</a></li>
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
                {{--  <h3 class="box-title"><a href="{{ route('admin.user.create') }}" class="btn btn-primary">Thêm mới </a></h3>  --}}
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
                      <th>ID -- STT</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Địa chỉ</th>
                      <th>Role</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                    @php
                       $i = 0;
                    @endphp
                    @if(isset($user))
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ ++$i .'--'. $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ Config::get('contants.GET_NAME_ROLE.'.$item->role, '[N\A]') }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    {{-- <a href="{{ route('admin.user.update',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a> --}}
                                    <a href="{{ route('admin.user.delete',$item->id) }}" class="btn btn-xs btn-danger js-delete-confirm"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              {!! $user->links() !!}
              <div></div>
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
