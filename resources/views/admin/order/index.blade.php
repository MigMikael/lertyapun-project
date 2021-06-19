@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="title">การจัดการคำสั่งซื้อ</h4>
            <span>รายการคำสั่งซื้อทั้งหมด</span>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                @include('admin.order._sort')
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/orders/search']) !!}
            <div class="input-group admin-search-wrapper">
                @if (isSet($search) && $search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตาม เลขที่คำสั่งซื้อ" autocomplete="off">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตาม เลขที่คำสั่งซื้อ" autocomplete="off">
                @endif
                <div class="input-group-append">
                    <button class="btn btn-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success', 'Success !') }}
        </div>
        @endif
        @if (session('fail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('fail', 'Fail !') }}
        </div>
    @endif

    @if (count($orders) === 0)
    <div class="text-center">
        <img class="search-no-result-img" src="{{ url('img/no-result.png') }}">
        <h5>ไม่พบข้อมูล</h5>
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">เลขที่คำสั่งซื้อ</th>
                <th scope="col">วันที่คำสั่งซื้อ</th>
                <th scope="col">ชื่อลูกค้า</th>
                <th scope="col" class="text-right">ยอดรวมทั้งหมด (บาท)</th>
                <th scope="col" class="text-center">สถานะคำสั่งซื้อ</th>
                <th scope="col" class="text-center">ดูข้อมูล</th>
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th>
                            {{ $loop->iteration }}
                        </th>
                        <td>
                            {{ $order->order_slug }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/y H:i:s') }}</td>
                        <td>
                            {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                        </td>
                        <td class="text-right">
                            {{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="text-center">
                            @if($order->order_status == 'pending')
                            <span class="badge badge-warning">รอการอนุมัติ</span>
                            @elseif($order->order_status == 'payment' && $order->slip_image_id == null)
                            <span class="badge badge-warning-secondary">รอการชำระเงิน</span>
                            @elseif($order->order_status == 'payment' && $order->slip_image_id != null)
                            <span class="badge badge-warning-secondary">รอยืนยันการชำระเงิน</span>
                            @elseif($order->order_status == 'credit')
                            <span class="badge badge-success">เครดิต</span>
                            @elseif($order->order_status == 'success')
                            <span class="badge badge-success">สำเร็จ</span>
                            @elseif($order->order_status == 'cancle')
                            <span class="badge badge-danger">ยกเลิก</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/orders/'.$order->order_slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $orders->render("pagination::bootstrap-4") }}
    </div>
</div>
@endsection

@section('script')
<script>
    $('.delete-action').click(function(e){
        e.preventDefault()
        if (confirm('Are you sure?')) {
            $(e.target).closest('form').submit()
        }
    });
</script>
@endsection
