@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Order Id {{ $order->id }}</h1>
    </div>
    <p>Customer {{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price(฿)</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ url('image/thumbnail/'.$product->image->slug) }}" style="height: 30px; width: 30px" class="img-fluid" alt="{{ $product->name }}">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->pivot->order_price) }}</td>
                        <td>{{ number_format($product->pivot->sale_quantity) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => 'admin/orders/'. $order->slug .'/status', 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('Order Status') !!}
                    {!! Form::select('status', $status, $order->status, ['class' => 'form-control']) !!}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-12">
            @if($order->slip_image_id != null)
                <img class="img-md" src="{{ url('image/thumbnail/'.$order->slipImage->slug) }}">
            @endif
        </div>
    </div>
@endsection
