@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Create Product</h1>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/products', 'method' => 'post', 'files' => 'true']) !!}
        @include('admin.product._form')
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    {!! Form::close() !!}
@endsection
