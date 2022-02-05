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
            <div class="admin-search-wrapper">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>สถานะคำสั่งซื้อ</label>
                        {!! Form::select('status', $orderStatus, $status, ['class' => 'form-control select2', 'style' => 'width:100% !important']) !!}
                    </div>
                    <div class="col-md-6 form-group">
                        <label>ค้นหา</label>
                        @if (isSet($search) && $search != '')
                        <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตาม เลขที่คำสั่งซื้อ" autocomplete="off">
                        @else
                        <input name="query" type="text" class="form-control" placeholder="ค้นหาตาม เลขที่คำสั่งซื้อ" autocomplete="off">
                        @endif
                    </div>
                    <div class="col-md-2 form-group">
                        <label style="visibility: hidden;">กดค้นหา</label>
                        <button class="btn btn-light btn-block" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
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
                <th scope="col" width="15%">เลขที่คำสั่งซื้อ</th>
                <th scope="col" width="15%">วันที่คำสั่งซื้อ</th>
                <th scope="col" width="15%">ชื่อร้าน</th>
                <th scope="col" width="15%">ชื่อลูกค้า</th>
                <th scope="col" class="text-right">ยอดรวมทั้งหมด (บาท)</th>
                <th scope="col" class="text-center">สถานะคำสั่งซื้อ</th>
                <th class="text-center">จัดการ</th>
                <th scope="col" class="text-center">ดูข้อมูล</th>
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th>
                            {{ $orders->firstItem() + $loop->index }}
                        </th>
                        <td>
                            {{ $order->order_slug }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/y') }} <br>
                            {{ \Carbon\Carbon::parse($order->order_date)->format('H:i') }} น.
                            <!--{{ \Carbon\Carbon::parse($order->order_date)->format('H:i:s') }}--></td>
                        <td>
                            {{ $order->customer->store_name }}
                        </td>
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
                            <span class="badge badge-primary">เครดิต</span>
                            @elseif($order->order_status == 'success')
                            <span class="badge badge-success">สำเร็จ</span>
                            @elseif($order->order_status == 'cancle')
                            <span class="badge badge-danger">ยกเลิก</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                {!! Form::model($order, [
                                    'method' => 'delete',
                                    'url' => 'admin/orders/'.$order->order_slug,
                                    'class' => '']) !!}
                                <button class="btn btn-danger btn-sm delete-action ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
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
    $('.select2').select2();

    $('.delete-action').click(function(e){
        e.preventDefault()
        if (confirm('คุณแน่ใจที่จะลบข้อมูลดังกล่าว หากลบแล้วจะไม่สามารถกู้คืนข้อมูลได้ ?')) {
            $(e.target).closest('form').submit()
        }
    });
</script>
@endsection
