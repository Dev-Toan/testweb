<form role="form" action="" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="col-md-7">
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Thông tin cơ bản</h3>
                </div>
                  <div class="box-body">
                    <div class="form-group {{ $errors->first('a_name') ? 'has-error' : '' }}">
                      <label for="a_name">Name</label>
                      <input type="text" name="a_name" class="form-control" value="{{ $article->a_name ?? old('a_name') }}"  placeholder="Name ....">
                        @if ($errors->first('a_name'))
                            <span class="text-danger">{{ $errors->first('a_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->first('a_description') ? 'has-error' : '' }}">
                        <label>Description</label>
                        <textarea class="form-control" value="" name="a_description" rows="3" placeholder="Enter ...">{{ $article->a_description ?? old('a_description') }}</textarea>
                        @if ($errors->first('a_description'))
                            <span class="text-danger">{{ $errors->first('a_description') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->first('a_menu_id') ? 'has-error' : '' }}">
                        <label>Menu (*)</label>
                        <select name="a_menu_id" class="form-control">
                          <option value="">_Click_</option>
                          @foreach ($menus as $item)
                            <option value="{{ $item->id }}" {{ (($article->a_menu_id ?? 0) == $item->id) ? 'selected' : '' }}>{{ $item->mn_name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->first('a_menu_id'))
                            <span class="text-danger">{{ $errors->first('a_menu_id') }}</span>
                        @endif
                    </div>
                  </div>
              </div>

        </div>

        <div class="col-md-5">
            {{--  <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Seo Cơ Bản</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Textarea</label>
                        <textarea class="form-control" value="{{ old('a_description_seo') }}" name="a_description_seo" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div>
              </div>  --}}

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Ảnh Đại Diện</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Ảnh Mới</label>
                        <div style="margin-bottom:10px" >
                        @if(isset($article))
                            <img src="{{ pare_url_file($article->a_avatar) }}" class="img-thumbnail" style="width: 170px;height:170px" alt="">
                        @endif
                            <img id="image_preview_container" src="{{ asset('images/no-image.jpg') }}"class="img-thumbnail" style="width: 170px;height:170px" alt="">
                        </div>
                        <input type="file" name="a_avatar" id="image"  class="js-upload">
                    </div>
                </div>
              </div>
        </div>
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Content</h3>
                </div>
                <div class="box-body">
                    <div class="form-group {{ $errors->first('a_content') ? 'has-error' : '' }}">
                        <label>Nội Dung</label>
                        <textarea class="form-control" value="" id="editor_js" name="a_content" rows="3" placeholder="Enter ...">{{ $article->a_content ?? old('a_content') }}</textarea>
                        @if ($errors->first('a_content'))
                            <span class="text-danger">{{ $errors->first('a_content') }}</span>
                        @endif
                    </div>
                </div>
              </div>
        </div>
        <div class="col-md-12">
            <div class="box-footer" style="text-align: center;">
                <a href="{{ route('admin.article.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở Lại</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
            </div>
        </div>
</form>
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
          };
        CKEDITOR.replace('editor_js',options);
    </script>
