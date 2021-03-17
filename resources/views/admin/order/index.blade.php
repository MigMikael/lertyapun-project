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
                @include('admin.tag._sort')
                <a class="btn btn-primary" href="{{ url("admin/orders/create") }}">
                    <i class="fas fa-plus"></i>
                    เพิ่มคำสั่งซื้อ
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            {!! Form::open(['method' => 'post', 'url' => 'admin/orders/search']) !!}
            <div class="input-group">
                @if ($search != '')
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาตามชื่อลูกค้า">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหาตามชื่อลูกค้า">
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
                <th scope="col">ชื่อลูกค้า</th>
                <th scope="col" class="text-right">ยอดรวมทั้งหมด (บาท)</th>
                <th scope="col" class="text-center">สถานะการชำระเงิน</th>
                <th scope="col" class="text-center">การจัดการ</th>
                <th scope="col" class="text-center">ดูข้อมูล</th>
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->customer->first_name }}</td>
                        <td class="text-right">{{ $order->total_amount }}</td>
                        <td class="text-center">{{ $order->status }}</td>
                        <td class="text-center">
                            {!! Form::model($order, [
                                'method' => 'delete',
                                'url' => 'admin/orders/'.$order->slug,
                                'class' => '']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ url('admin/orders/'.$order->slug.'/edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" type="submit" style="margin-left: 5px">
                                <i class="fas fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/orders/'.$order->slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td>
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
