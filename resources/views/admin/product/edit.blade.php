@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Edit Product</h1>
    </div>
    <hr>
    {!! Form::model($product, ['url' => 'admin/products/'.$product->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.product._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
