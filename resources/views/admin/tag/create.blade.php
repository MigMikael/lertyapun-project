@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Create Promotion (Tag)</h1>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/tags', 'method' => 'post', 'files' => 'true']) !!}
        @include('admin.tag._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
