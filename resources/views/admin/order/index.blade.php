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
                {{-- <a class="btn btn-primary" href="{{ url("admin/orders/create") }}" disabled>
                    <i class="fas fa-plus"></i>
                    เพิ่มคำสั่งซื้อ
                </a> --}}
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/orders/search']) !!}
            <div class="input-group">
                @if (isSet($search) && $search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตามชื่อนามสกุลลูกค้าและหมายเลขคำสั่งซื้อ">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตามชื่อนามสกุลลูกค้าและหมายเลขคำสั่งซื้อ">
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

    <div class="mb-2" style="width: 100%; height: 40px">
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
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">หมายเลขคำสั่งซื้อ</th>
                <th scope="col">วันที่คำสั่งซื้อ</th>
                <th scope="col">ชื่อลูกค้า</th>
                <th scope="col" class="text-right">ยอดรวมทั้งหมด (บาท)</th>
                <th scope="col" class="text-center">สถานะคำสั่งซื้อ</th>
                {{-- <th scope="col" class="text-center">การจัดการ</th> --}}
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr onclick="window.location='{{ url('admin/orders/'.$order->order_slug) }}'">
                        <th>
                            {{ $loop->iteration }}
                        </th>
                        <td>
                            {{ $order->order_slug }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/y - h:m') }} น.</td>
                        <td>
                            {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                        </td>
                        <td class="text-right">
                            {{ number_format($order->total_amount) }}
                        </td>
                        <td class="text-center">
                            @if($order->order_status == 'pending')
                            <span class="badge badge-secondary">รอการอนุมัติ</span>
                            @elseif($order->order_status == 'payment' && $order->slip_image_id == null)
                            <span class="badge badge-warning">รอการชำระเงิน</span>
                            @elseif($order->order_status == 'payment' && $order->slip_image_id != null)
                            <span class="badge badge-warning">รอยืนยันการชำระเงิน</span>
                            @elseif($order->order_status == 'success')
                            <span class="badge badge-success">สำเร็จ</span>
                            @elseif($order->order_status == 'cancle')
                            <span class="badge badge-danger">ยกเลิก</span>
                            @endif
                        </td>
                        {{-- <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" onclick="event.preventDefault()'">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ url('admin/orders/'.$order->order_slug.'/edit') }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    {!! Form::model($order, [
                                        'method' => 'delete',
                                        'url' => 'admin/orders/'.$order->order_slug,
                                        'class' => '']) !!}
                                    <button class="dropdown-item text-danger delete-action">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
