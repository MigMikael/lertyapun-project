@extends('template.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Edit Promotion (Tag)</h1>
    </div>
    <hr>
    {!! Form::model($tag, ['url' => 'admin/tags/'.$tag->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.tag._form')
        <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
