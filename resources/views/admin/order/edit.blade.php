@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Edit Order</h1>
    </div>
    <hr>
    {!! Form::model($order, ['url' => 'admin/orders/'.$order->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.order._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
