@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Edit Customer</h1>
    </div>
    <hr>
    {!! Form::model($customer, ['url' => 'admin/customers/'.$customer->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.customer._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
