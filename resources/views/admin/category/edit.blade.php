@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Edit Category</h1>
    </div>
    <hr>
    {!! Form::model($category, ['url' => 'admin/categories/'.$category->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.category._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
