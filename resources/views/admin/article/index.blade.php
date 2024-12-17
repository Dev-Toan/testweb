@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
        Article
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.article.index') }}">Article</a></li>
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
                <h3 class="box-title"><a href="{{ route('admin.article.create') }}" class="btn btn-primary">Thêm mới </a></h3>
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
                      <th>STT -- ID</th>
                      <th>name</th>
                      <th>Menu</th>
                      <th>Avatar</th>
                      <th>Hot</th>
                      <th>Status</th>
                      <th>Times</th>
                      <th>Action</th>
                    </tr>
                    @php
                       $i = 0;
                    @endphp
                    @if(isset($articles))
                        @foreach ($articles as $item)
                            <tr>
                                <td>{{ ++$i . ' -- ' .  $item->id}}</td>
                                <td>{{ $item->a_name }}</td>
                                <td><span class="label label-success">{{ $item->menu->mn_name ?? "[N\A]" }}</span></td>
                                <td><img src="{{ pare_url_file($item->a_avatar) }}" alt="" width="150px" height="100px"> </td>
                                <td>
                                    @if ($item->a_hot==1)
                                        <a href="{{ route('admin.article.hot',$item->id) }}" class="label label-info">Hot</a>
                                    @else
                                         <a href="{{ route('admin.article.hot',$item->id) }}" class="label label-default">None</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->a_active==1)
                                        <a href="{{ route('admin.article.active',$item->id) }}" class="label label-info">Active</a>
                                    @else
                                         <a href="{{ route('admin.article.active',$item->id) }}" class="label label-default">Hide</a>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.article.update',$item->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="{{ route('admin.article.delete',$item->id) }}" class="btn btn-xs btn-danger js-delete-confirm"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              <div>{!! $articles->links() !!}</div>
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
