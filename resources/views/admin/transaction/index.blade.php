@extends('layout.master_admin')
@section('content')
<section class="content-header">
    <h1>
      Quản lý đơn hàng
      <small>index</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ route('admin.transaction.index') }}">transaction</a></li>
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
                    <div class="box-title">
                        <form action="" method="GET" class="form-inline">
                            <input type="text" value="{{ Request::get('id') }}" class="form-control" name="id" placeholder="ID">
                            <input type="text" value="{{ Request::get('email') }}" class="form-control" name="email" placeholder="Email ...">
                            {{-- <select name="type" class="form-control">
                                <option value="0">__Phân Loại Khách__</option>
                                <option value="1" {{ Request::get('type') == 1 ? "selected='selected'" : "" }}>Thành Viên</option>
                                <option value="2" {{ Request::get('type') == 2 ? "selected='selected'" : "" }}>Khách</option>
                            </select> --}}
                            <select name="status" class="form-control">
                                <option value="0">__Trạng Thái__</option>
                                <option value="1" {{ Request::get('status') == 1 ? "selected='selected'" : "" }}>Tiếp Nhận</option>
                                <option value="2" {{ Request::get('status') == 2 ? "selected='selected'" : "" }}>Đang Vận Chuyển</option>
                                <option value="3" {{ Request::get('status') == 3 ? "selected='selected'" : "" }}>Đã Bàn Giao</option>
                                <option value="-1" {{ Request::get('status') == -1 ? "selected='selected'" : "" }}>Hủy Bỏ</option>
                            </select>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Search</button>
                        </form>
                    </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th>ID</th>
                      <th>Info</th>
                      {{-- <th>Account</th> --}}
                      <th>Money</th>
                      <th>Status</th>
                      <th>Phương thức TT</th>
                      <th>Time</th>
                      <th>Action</th>
                    </tr>
                    @if(isset($transactions))
                        @foreach ($transactions as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <ul>
                                        <li>Name: {{ $item->tst_name }}</li>
                                        <li>Email: {{ $item->tst_email }}</li>
                                        <li>Phone: {{ $item->tst_phone }}</li>
                                        <li>Address: {{ $item->tst_address }}</li>
                                    </ul>
                                </td>
                                {{-- <td>
                                    @if ($item->tst_user_id)
                                        <span class="label label-warning">Thành Viên</span>
                                    @else
                                        <span class="label label-default">Khách</span>
                                    @endif
                                </td> --}}
                                <td>{{ number_format($item->tst_total_money,0,',','.') }}</td>
                                <td>
                                    <span class="label label-{{ $item->getStatus($item->tst_status)['class'] }}">
                                        {{ $item->getStatus($item->tst_status)['name'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="label label-{{ $item->tst_type == config('contants.PTTT.THUONG') ? 'info' : 'success' }}">
                                        {{ $item->tst_type == config('contants.PTTT.THUONG') ? 'Thường' : 'Online' }}
                                    </span>
                                </td>
                                <td>{{ date("d/m/Y H:i:s", strtotime($item->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('admin.transaction.detail',$item->id) }}" class="btn btn-xs btn-info js-preview-transaction"><i class="fa fa-eye"></i>View</a>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-xs">Action</button>
                                        <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('admin.transaction.delete',$item->id) }}" class=""><i class="fa fa-trash js-delete-confirm"></i> Delete</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="{{ route('admin.transaction.action',['process',$item->id]) }}"><i class="fa fa-ban"> Đang Vận Chuyển</i></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.transaction.action',['success',$item->id]) }}"><i class="fa fa-ban"> Đã Bàn Giao</i></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.transaction.action',['cancel',$item->id]) }}"><i class="fa fa-ban"> Hủy</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
              {!! $transactions->appends($query)->links() !!}
              <div></div>
            </div>
            <!-- /.box -->
          </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
  </section>
    {{--  <div class="modal fade fade" id="modal-preview-transaction" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Chi Tiết Đơn hàng <b></b></h4>
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
    </div>  --}}
  <!-- /.content -->
@endsection
{{--  @section('script')
    <script>
        $('.js-preview-transaction').click(function(e){
            e.preventDefault();
            let $this=$(this);
            let URL=$this.attr('href');
            $.ajax({
                url:URL,
                success:function(results){
                    $('#modal-preview-transaction .content').html(results.html)
                    $('#modal-preview-transaction').modal({
                        show:true
                    });
                },
                error:function(e){
                    console.log(e.message);
                }
            });
        });
        $('body').on('click','.js-delete-order-item',function(event){
            event.preventDefault();
            let URL=$(this).attr('href');
            let $this=$(this);
            $.ajax({
                url:URL,
                success:function(results){
                    if(results.code==200){
                        $this.parents('tr').remove();
                    }
                },
                error:function(e){
                    console.log(e.message);
                }
            })
        });
    </script>
@endsection  --}}
