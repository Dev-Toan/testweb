@extends('layout.master_admin')
@section('content')

<section class="content-header">
  <h1>
    Thống Kê
    <small>website</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">thống kê</li>
  </ol>
</section>
<section class="content">
     <div class="row" style="margin-bottom: 20px">

        <div class="col-sm-8">
            {{-- <div class="box-title">
                <form action="" method="GET" class="form-inline">
                    <select name="mt" class="form-control">
                        <option value="">_ Tháng trong năm _</option>
                        @for ($i = 1; $i <=12; $i++)
                            <option value="{{$i}}" {{ Request::get('mt') == $i ? "selected='selected'" : "" }}>Tháng {{$i}}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Search</button>
                     <button type="submit" name="export" value="true" class="btn btn-info">
                        <i class="fa fa-save"> </i> Export
                    </button> 
                </form>
            </div><br> --}}
            <figure class="highcharts-figure">
                <div id="container2" 
                data-list-day="{{ $listDay }}" 
                data-money-default="{{ $arrRevenueTransactionMonthDefault }}"
                data-money-process="{{ $arrRevenueTransactionMonthProcess }}"
                data-money-success="{{ $arrRevenueTransactionMonthSuccess }}"
                data-money-cancel="{{ $arrRevenueTransactionMonthCancel }}"
                data-mt = "{{ $mt }}"
                ></div>
            </figure>
        </div>
        <div class="col-sm-4">
            <figure class="highcharts-figure">
                <div id="container" data-json="{{ $statusTransaction }}"></div>
            </figure>
        </div>
    </div> 
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-7">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Doanh Số</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <span style="color: red">Không chọn gì mặc định lấy các ngày trong tháng và năm hiện tại.</span>
                        <div class="box-title">
                            <form action="" method="GET" class="form-inline">
                                <input type="date" value="{{Request::get('dateBefore')}}" name="dateBefore" class="form-control" id="validationCustom01">
                                <input type="date" value="{{Request::get('dateAfter')}}" name="dateAfter" class="form-control {{ $errors->first('dateAfter') ? 'is-valid' : '' }}" id="validationCustom01">
                                @if ($errors->first('dateAfter'))
                                    <span class="text-danger">{{ $errors->first('dateAfter') }}</span>
                                @endif
                                <select name="day" class="form-control">
                                    <option value="" >_ Ngày trong tháng _</option>
                                    @for ($i = 1; $i <=31; $i++)
                                        <option value="{{$i}}" {{ Request::get('day') == $i ? "selected='selected'" : "" }}>Ngày {{$i}}</option>
                                    @endfor
                                </select>
                                <select name="month" class="form-control">
                                    <option value="">_ Tháng trong năm _</option>
                                    @for ($i = 1; $i <=12; $i++)
                                        <option value="{{$i}}" {{ Request::get('month') == $i ? "selected='selected'" : "" }}>Tháng {{$i}}</option>
                                    @endfor
                                </select>
                                <select name="year" class="form-control">
                                    <option value="">_ Năm _</option>
                                    <option value="2019" {{ Request::get('year') == 2019 ? "selected='selected'" : "" }}>Năm 2019</option>
                                    <option value="2020" {{ Request::get('year') == 2020 ? "selected='selected'" : "" }}>Năm 2020</option>
                                    <option value="2021" {{ Request::get('year') == 2021 ? "selected='selected'" : "" }}>Năm 2021</option>
                                    <option value="2022" {{ Request::get('year') == 2022 ? "selected='selected'" : "" }}>Năm 2022</option>
                                    <option value="2023" {{ Request::get('year') == 2023 ? "selected='selected'" : "" }}>Năm 2023</option>
                                </select>
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Search</button>
                                {{--  <button type="submit" name="export" value="true" class="btn btn-info">
                                    <i class="fa fa-save"> </i> Export
                                </button>  --}}
                            </form>
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tổng Tiền</th>
                                    <th>Ngày</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($moneyTransaction))
                                    @foreach ($moneyTransaction as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ number_format($item->totalMoney,0,',','.') }} vnd</td>
                                            <td> 
                                                @if (!(empty(Request::get('year'))) && empty(Request::get('day')) && empty(Request::get('month')))
                                                    Tháng {{ $item->day }} Năm {{Request::get('year')}}
                                                @else
                                                    {{ $item->day }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td>Tổng</td>
                                            <td><span style="color: red">{{ number_format($totalMoneyTransaction,0,',','.') }} vnd</span></td>
                                            <td></td>
                                        </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Top 10 khách hàng mua chi nhiều tiền nhất</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Info</th>
                                    <th>Money</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($userTransaction))
                                    @foreach ($userTransaction as $key =>$item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <ul>
                                                    <li>Name: {{ $item->user->name }}</li>
                                                    <li>Email: {{ $item->user->email }}</li>
                                                    <li>Phone: {{ $item->user->phone }}</li>
                                                    <li>Address: {{ $item->user->address }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ number_format($item->totalMoney , 0, ',', '.') }} vnđ</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="box-footer clearfix" style="">
                     <a href="{{ route('admin.transaction.index') }}" class="btn btn-sm btn-info btn-flat pull-right">Danh Sách</a> 
                </div> --}}
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">top sản phẩm bán trong tháng 7</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($productsT7))
                                    @foreach ($productsT7 as $key =>$item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <ul>
                                                    <li>Name: {{ $item->product->pro_name }}</li>
                                                    {{-- <li>Email: {{ $$item->product->pro_price }}</li> --}}
                                                    <li>tổng sô: {{$item->total}}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

 @section('script')
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        let dataTransaction = $('#container').attr('data-json');
        dataTransaction = JSON.parse(dataTransaction);
        Highcharts.chart('container', {
            chart: {
                styledMode: true
            },

            title: {
                text: 'Biểu đồ số đơn hàng'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data:dataTransaction ,
                showInLegend: true
            }]
        });




        let listday = $('#container2').attr('data-list-day');
        listday = JSON.parse(listday);

        let listMoneyMonthDefault = $('#container2').attr('data-money-default');
        listMoneyMonthDefault = JSON.parse(listMoneyMonthDefault);

        let listMoneyMonthProcess = $('#container2').attr('data-money-process');
        listMoneyMonthProcess = JSON.parse(listMoneyMonthProcess);

        let listMoneyMonthSuccess = $('#container2').attr('data-money-success');
        listMoneyMonthSuccess = JSON.parse(listMoneyMonthSuccess);

        let listMoneyMonthCancel = $('#container2').attr('data-money-cancel');
        listMoneyMonthCancel = JSON.parse(listMoneyMonthCancel);

        let mt = $('#container2').attr('data-mt');


        Highcharts.chart('container2', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Biểu đồ doanh số các ngày trong tháng ' + mt
            },
            subtitle: {
                text: 'Hải Anh Watch'
            },
            xAxis: {
                categories: listday
            },
            yAxis: {
                title: {
                    text: 'Số tiền'
                },
                labels: {
                    formatter: function () {
                        return new Intl.NumberFormat().format(this.value) + ' VND';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [
                {
                    name: 'Tiếp Nhận',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthDefault
                },
                {
                    name: 'Đang vận chuyển',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthProcess
                },
                {
                    name: 'Đã Bàn Giao',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthSuccess
                },
                {
                    name: 'Đã hủy',
                    marker: {
                        symbol: 'square'
                    },
                    data:listMoneyMonthCancel
                }
            ]
        });
    </script>
@endsection 
