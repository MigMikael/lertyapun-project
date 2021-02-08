@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Order Id {{ $order->id }}</h1>
    </div>
    <p>Customer {{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
@endsection
