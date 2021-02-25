@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4 mb-1">Order</h1>
        <div class="d-flex mt-4 mb-1" style="flex-direction: row">
            @include('admin.order._sort')
            <div>
                <a class="btn btn-primary" href="{{ url("admin/orders/create") }}">
                    <i class="fas fa-plus"></i>
                    Add
                </a>
            </div>
        </div>
    </div>

    <div class="mb-2" style="width: 100%; height: 35px">
        @if (session('success'))
            <div style="background-color: #DCEDC8">
                {{ session('success', 'Success !') }}
            </div>
        @endif
        @if (session('fail'))
            <div style="background-color: #EF9A9A">
                {{ session('fail', 'Fail !') }}
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Total (฿)</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                <th scope="col">View</th>
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->customer->first_name }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            {!! Form::model($order, [
                                'method' => 'delete',
                                'url' => 'admin/orders/'.$order->slug,
                                'class' => 'form-inline']) !!}
                            <a class="btn btn-warning btn-sm" href="{{ url('admin/orders/'.$order->slug.'/edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" type="submit" style="margin-left: 5px">
                                <i class="fas fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/orders/'.$order->slug) }}">
                                <i class="fas fa-external-link-square-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $orders->render("pagination::bootstrap-4") }}
@endsection
