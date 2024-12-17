@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Attribute
      <small>Carete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.attribute.index') }}">Attribute</a></li>
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
                    <div class="form-group {{ $errors->first('atb_name') ? 'has-error' : '' }}">
                        <label for="name">Names <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" name="atb_name" placeholder="Name ......">
                        @if ($errors->first('atb_name'))
                            <span class="text-danger">{{ $errors->first('atb_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group {{ $errors->first('atb_type') ? 'has-error' : '' }}">
                        <label> Nhóm Thuộc Tính <span class="text-danger">(*)</span></label>
                        <select name="atb_type" class="form-control">
                            {{--  <option >-- Chọn Nhóm Thuộc Tính --</option>  --}}
                            @foreach ($arrType->getType() as $key =>$item)
                                <option value="{{ $key }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('atb_type'))
                            <span class="text-danger">{{ $errors->first('atb_type') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group {{ $errors->first('atb_category_id') ? 'has-error' : '' }}">
                        <label>Danh Mục <span class="text-danger">(*)</span></label>
                        <select name="atb_category_id" class="form-control">
                            {{--  <option >_ Danh Mục _</option>  --}}
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->c_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->first('atb_category_id'))
                            <span class="text-danger">{{ $errors->first('atb_category_id') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
            <div class="box-footer" >
                <a href="{{ route('admin.attribute.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
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
