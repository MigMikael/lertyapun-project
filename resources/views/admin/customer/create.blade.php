@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Create Customer</h1>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/customers', 'method' => 'post', 'files' => 'true']) !!}
        @include('admin.customer._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
