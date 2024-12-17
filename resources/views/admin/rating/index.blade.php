@extends('layout.master_admin')
@section('css')
    <style>
        .ratings span i{
            color: #eff0f5;
        }
        .ratings span.active i{
            color: #faca51;
        }
    </style>
@endsection
@section('content')
<section class="content-header">
    <h1>
      Ratings
      <small>danh sách đánh giá sản phẩm</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.rating.index') }}">Rating</a></li>
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
                {{--  <h3 class="box-title"><a href="{{ route('admin.ratings.create') }}" class="btn btn-primary">Thêm mới </a></h3>  --}}
                {{--  <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>  --}}
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding" id="js-datas">
                @include('admin.rating.data')
              </div>
              {{-- {!! $ratings->appends($query)->links() !!} --}}

              <!-- /.box-body -->
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
    <div class="modal fade" id="modal-preview-rating">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Rating</h4>
                </div>
                <div class="modal-body">
                    <div class="content">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){

            // $(document).on('click', '.pagination a', function(event){
            //     event.preventDefault();
            //     var page = $(this).attr('href').split('page=')[1];
            //     $('#hidden_page').val(page);
            //     var column_name = $('#hidden_column_name').val();
            //     var sort_type = $('#hidden_sort_type').val();

            //     var query = $('#serach').val();

            //     $('li').removeClass('active');
            //     $(this).parent().addClass('active');
            //     fetch_data(page, sort_type, column_name, query);
            // });

            $(document).on('click', '.page-link', function(event){
            event.preventDefault(); 
            var page = $(this).attr('href').split('page=')[1];
            let URL = $(this).attr('href');
            console.log(URL)
            fetch_data(URL);
            });

            $(document).on('click','.status-actives',function(e){
                e.preventDefault();
                var URL = $(this).attr('href');
                console.log(URL);
                fetch_data(URL);
            });

            

            // $(document).on('click','.status-actives',function(e){
            //     e.preventDefault();
            //     var URL = $(this).attr('href');
            //     let idRating = $(this).attr('data-id');
            //     var page = $(location).attr('search').split('page=')[1];
            //     if(page == undefined) page = 1;
            //     // console.log(page);
            //     $.ajax({
            //         url:URL,
            //         'data' : {
            //             idRating : idRating,
            //             page : page
            //         },
            //         type:"GET",
            //         success:function(results){
            //             {{--  console.log(results.data);  --}}
            //             if(results.data){
            //                 $("#js-datas").html(results.data);
            //                 console.log(results)
            //             }
            //             toastr.success(results.messages);
            //         }
            //     });
            // });

            $(document).on('click','.js-preview-rating',function(e){
                e.preventDefault();
                let URL = $(this).attr('href');
                $.ajax({
                    url:URL,
                    type:"GET",
                    success:function(results){
                        $("#modal-preview-rating .content").html(results.data);
                        $('#modal-preview-rating').modal({
                            show:true
                        });
                        toastr.info(results.messages);
                    }
                });
            });

            function fetch_data(URL){
                $.ajax({
                    url:URL,
                    type:"GET",
                    success:function(results){
                        $('#js-datas').html(results.data);
                        if(results.messages) {
                            toastr.success(results.messages);
                        }         
                    }
                });
            }

        });
    </script>
@endsection