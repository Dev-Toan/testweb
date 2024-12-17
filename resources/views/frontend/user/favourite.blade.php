@extends('layout.master_user');
    <style>

    </style>
@section('content')
    <section class="py-4 py-lg-5" style="background: white;padding: 20px">
        <h2>Danh Sách Sản Phẩm Yêu Thích</h2>
        <div class="row mb-5">
            <div class="col-sm-12">
                {{-- <form class="form-inline">
                    <div class="form-group mx-sm-2 mb-2">
                        <input type="text" name="id" class="form-control"  placeholder="Mã đơn hàng ID" value="{{ Request::get('id') }}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="status" class="form-control">
                            <option value="0">__Trạng Thái__</option>
                            <option value="1" {{ Request::get('status') == 1 ? "selected='selected'" : "" }}>Tiếp Nhận</option>
                            <option value="2" {{ Request::get('status') == 2 ? "selected='selected'" : "" }}>Đang Vận Chuyển</option>
                            <option value="3" {{ Request::get('status') == 3 ? "selected='selected'" : "" }}>Đã Bàn Giao</option>
                            <option value="-1" {{ Request::get('status') == -1 ? "selected='selected'" : "" }}>Hủy Bỏ</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Tìm Kiếm</button>
                </form> --}}
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Price</th>
                                <th scope="col">Hot</th>
                                <th scope="col">Times</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @if(isset($products))
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <th>{{ $item->id }}</th>
                                        <td scope="row">{{ $item->pro_name }}</td>
                                        <td><span class="label ">{{ $item->category->c_name ?? "[N\A]" }}</span></td>
                                        <td><img width="100px" height="100px" src="{{ pare_url_file($item->pro_avatar) }}" alt=""></td>
                                        <td>{{ number_format($item->pro_price,0,',','.') }}</td>
                                        <td>
                                            @if ($item->pro_hot==1)
                                                <a  class="label label-info">Hot</a>
                                            @else
                                                 <a class="label label-default">None</a>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><a href="{{route('get.product.detail',$item->pro_slug . '-' . $item->id)}}" target="_blank"> view</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
