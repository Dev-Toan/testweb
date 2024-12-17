@extends('layout.master_user');
    <style>
        .count-text{
            text-align: center;
            color: white;
            font-size: 35px;
        }
        .count-name{
            text-align: center;
            color: white;
        }
        .box-count{
            padding: 15px 10px;
        }
    </style>
@section('content')
    <section class="py-12 py-lg-12">
        <div class="row mb-12">
            <div class="col-2">
                <div class="box-count" style="background: #00c0ef">
                    <div class="count-text">{{ $transaction_total }}</div>
                    <h4 class="count-name">Tổng Đơn</h4>
                </div>
            </div>
            <div class="col-2">
                <div class="box-count" style="background: #00efbb">
                    <div class="count-text">{{ $transaction_default }}</div>
                    <h4 class="count-name">Vừa tiếp nhận</h4>
                </div>
            </div>
            <div class="col-2">
                <div class="box-count" style="background: #dd4b39">
                    <div class="count-text">{{ $transaction_cancel }}</div>
                    <h4 class="count-name">Đơn Hủy</h4>
                </div>
            </div>
            <div class="col-2">
                <div class="box-count" style="background: #f39c12">
                    <div class="count-text">{{ $transaction_transported }}</div>
                    <h4 class="count-name">Đang Vận chuyển</h4>
                </div>
            </div>
            <div class="col-2">
                <div class="box-count" style="background: #00a65a">
                    <div class="count-text">{{ $transaction_success }}</div>
                    <h4 class="count-name">Hoàn Thành</h4>
                </div>
            </div>
        </div>
    </section>
@endsection
