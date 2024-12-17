@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Type
      <small>Carete</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.typeproduct.index') }}">TyPe Pro</a></li>
      <li class="active">Create</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

    <div class="box box-primary">
        <form role="form" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="col-sm-8">
                    <div class="form-group {{ $errors->first('tp_name') ? 'has-error' : '' }}">
                        <label for="name">Names <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" name="tp_name" placeholder="Name ......" required>
                        @if ($errors->first('tp_name'))
                            <span class="text-danger">{{ $errors->first('tp_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label>Danh Mục (*)</label>
                        <select name="tp_category_id" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" >{{ $item->c_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Ảnh Mới</label>
                            <div style="margin-bottom:10px" >
                                <img id="image_preview_container" src="{{ asset('admin/product.jpg') }}" class="img-thumbnail" style="width: 220px;height:200px" alt=""></div>
                            <input type="file" name="tp_avatar" id="image"  class="js-upload">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('admin.typeproduct.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
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
@section('script')
    <script>
        $(function(){
            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                  $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
