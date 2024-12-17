@extends('layout.master_user');
    <style>
        .label-default {
            color: #00c0ef
        }
        .label-info {
            color: #00efbb
        }
        .label-success {
            color: #00ef58
        }
        .label-danger {
            color: #ef6800
        }
    </style>
@section('content')
    <section class="py-4 py-lg-5" style="background: white;padding: 20px">
        <h2>Danh Sách Đơn Hàng</h2>
        <div class="row mb-5">
            <div class="col-sm-12">
                <form class="form-inline">
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
                </form>
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ngày Tạo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->tst_name }}</td>
                                    <td>{{ number_format($item->tst_total_money,0,',','.') }} vnđ</td>
                                    <td>
                                        <span class="label label-{{ $item->getStatus($item->tst_status)['class'] }}">
                                            {{ $item->getStatus($item->tst_status)['name'] }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><a href="{{route('get.user.transaction.detail', $item->id)}}">xem</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
