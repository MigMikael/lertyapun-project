@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Order</h1>
        <div>
            <a class="btn btn-primary" href="{{ url("admin/orders/create") }}">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Total (฿)</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
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
                        <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fas fa-trash"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->render("pagination::bootstrap-4") }}
@endsection
