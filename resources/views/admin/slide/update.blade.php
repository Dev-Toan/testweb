@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Slide
      <small>Update</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.slide.index') }}">Slide</a></li>
      <li class="active">Update</li>

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
                <div class="col-sm-7">
                    <div class="col-sm-12">
                        <div class="form-group {{ $errors->first('sd_title') ? 'has-error' : '' }}">
                            <label for="name">Title <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="sd_title" value="{{ $slide->sd_title }}" placeholder="Name ......">
                            @if ($errors->first('sd_title'))
                                <span class="text-danger">{{ $errors->first('sd_title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group {{ $errors->first('sd_link') ? 'has-error' : '' }}">
                            <label for="link">Links <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" value="{{ $slide->sd_link }}" name="sd_link" placeholder="link ......">
                            @if ($errors->first('sd_link'))
                                <span class="text-danger">{{ $errors->first('sd_link') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->first('sd_target') ? 'has-error' : '' }}">
                                    <label for="name">Target </label>
                                    <select name="sd_target" class="form-control">
                                        <option value="1" {{ $slide->sd_target == 1 ? "selected" : "" }}>_blank</option>
                                        <option value="2" {{ $slide->sd_target == 2 ? "selected" : "" }}>_self</option>
                                        <option value="3" {{ $slide->sd_target == 3 ? "selected" : "" }}>_parent</option>
                                        <option value="4" {{ $slide->sd_target == 4 ? "selected" : "" }}>_top</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->first('sd_sort') ? 'has-error' : '' }}">
                                    <label for="name">Sort </label>
                                    <input type="text" class="form-control" value="{{ $slide->sd_sort }}" name="sd_sort" placeholder="0">
                                    @if ($errors->first('sd_sort'))
                                        <span class="text-danger">{{ $errors->first('sd_sort') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Ảnh Mới</label>
                            <div style="margin-bottom:10px" >
                                <img src="{{ pare_url_file($slide->sd_image) }}" class="img-thumbnail" style="width: 100%;height:250px" alt="">
                                <img id="image_preview_container" src="{{ asset('admin/product.jpg') }}" class="img-thumbnail" style="width: 100%;height:300px" alt="">
                            </div>
                                <input type="file" name="sd_image" id="image"  class="js-upload">
                        </div>
                    </div>
                </div>



            </div>
            <div class="box-footer">
                <a href="{{ route('admin.slide.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
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
            //run js-select2-keyword
            if($('.js-select2-keyword').length >0){
                $('.js-select2-keyword').select2({
                    placeholder :'Chọn Keyword',
                    maximumSelectionLength : 3
                });

            }
        });

    </script>
@endsection
