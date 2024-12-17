@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Menu
      <small>Carete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.menu.index') }}">Menu</a></li>
      <li class="active">Create</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

    <div class="box box-primary">
        <form role="form" action="" method="POST">
            @csrf
            <div class="box-body">
                <div class="col-sm-8">
                    <div class="form-group {{ $errors->first('mn_name') ? 'has-error' : '' }}">
                        <label for="name">Names <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" name="mn_name" placeholder="Name ......">
                        @if ($errors->first('mn_name'))
                            <span class="text-danger">{{ $errors->first('mn_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group {{ $errors->first('mn_description') ? 'has-error' : '' }}">
                        <label for="name">Description </label>
                        <input type="text" class="form-control" name="mn_description" placeholder="Description ......">
                        @if ($errors->first('mn_description'))
                            <span class="text-danger">{{ $errors->first('mn_description') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
            <div class="box-footer" >
                <a href="{{ route('admin.menu.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
            </div>
            </div>
        </form>
    </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
  </section>
  <!-- /.content -->
@endsection
